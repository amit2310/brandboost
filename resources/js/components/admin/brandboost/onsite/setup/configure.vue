<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Review Campaign</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="btn btn-md bkg_light_800 light_000" >Save Campaign <span><img src="assets/images/arrow-right-circle-fill-white.svg"></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">
            <div class="container-fluid">
                <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
                <loading :isLoading="loading"></loading>
                <!--******************
                PAGE LEFT SIDEBAR
               **********************-->
                <a class="close_sidebar" href="#">&nbsp; <img src="assets/images/menu-2-line.svg"></a>
                <div class="page_sidebar bkg_light_000 fixed">
                    <div style="width: 279px;">
                        <div class="p20 bbot top_headings">
                            <div class="row">
                                <div class="col"><p>Review Campaign</p></div>
                            </div>
                        </div>

                        <div class="p30 pb10 text-center">
                            <img src="assets/images/review_setup_graph.svg"/>
                        </div>

                        <div class="p30 pb15">
                            <div class="row">
                                <div class="col-9">
                                    <p class="htxt_medium_12 dark_200 ls_4 m-0 ml20">EMAIL REQUESTS</p>
                                </div>
                                <div class="col-3">
                                    <label class="custom-form-switch mt-0 float-right">
                                        <input class="field" type="checkbox" checked="">
                                        <span class="toggle reviews"></span>
                                    </label>
                                </div>
                            </div>
                            <ul class="list_review mt-3">
                                <li><a class="active" href="#">From</a></li>
                                <li><a href="#">Email Subject</a></li>
                                <li><a class="" href="#">Content</a></li>
                                <li><a href="#">Settings & Tracking</a></li>
                            </ul>
                        </div>

                        <div class="pl30 pr30"><hr class="m-0"></div>

                        <div class="p30 pb15">
                            <div class="row">
                                <div class="col-9">
                                    <p class="htxt_medium_12 dark_200 ls_4 m-0 ml20">SMS REQUESTS</p>
                                </div>
                                <div class="col-3">
                                    <label class="custom-form-switch mt-0 float-right">
                                        <input class="field" type="checkbox" checked="">
                                        <span class="toggle reviews"></span>
                                    </label>
                                </div>
                            </div>
                            <ul class="list_review mt-3">
                                <li><a class="" href="#">From</a></li>
                                <li><a href="#">Content</a></li>
                                <li><a class="" href="#">Settings & Tracking</a></li>
                            </ul>
                        </div>



                        <div class="reviw_howtouse">
                            <a href="#" class="close_x_icon2"><img src="assets/images/close_grey_line.svg"/></a>
                            <p class="fsize12 fw300 light_000">Learn how to use <br><strong>Campaigns</strong> in 60 seconds</p>
                            <img src="assets/images/review_play.svg"/>
                        </div>




                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--******************
                  PAGE LEFT SIDEBAR END
                 **********************-->



                <div class="table_head_action pb0 mb15">
                    <div class="row">
                        <div class="col">
                            <h3 class="htxt_medium_14 dark_600">Email channel</h3>
                        </div>
                        <div class="col text-right">
                            <p class="fsize14 dark_600 m-0">Active &nbsp; &nbsp;
                                <label class="custom-form-switch mt-0">
                                    <input class="field" type="checkbox" checked="">
                                    <span class="toggle green3"></span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card p35 br6 mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">1</span></div>
                                <div class="col">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">From</h3>
                                    <p class="htxt_regular_14 dark_400 m-0 ls4">Who is sending this review request?</p>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Add sender</button>
                                </div>
                            </div>
                        </div>

                        <div class="card p35 br6 mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">2</span></div>
                                <div class="col">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">Subject</h3>
                                    <p class="htxt_regular_14 dark_400 m-0 ls4">Add your email’s subject line</p>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Add subject</button>
                                </div>
                            </div>
                        </div>

                        <div class="card p35 br6 mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">3</span></div>
                                <div class="col">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">Content</h3>
                                    <p class="htxt_regular_14 dark_400 m-0 ls4">Customize the content of your email.</p>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit content</button>
                                </div>
                            </div>
                        </div>

                        <div class="card p35 br6 mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">4</span></div>
                                <div class="col">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">Settings & Tracking</h3>
                                    <p class="htxt_regular_14 dark_400 m-0 ls4">Customize your default campaign’s settings</p>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit Settings</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="table_head_action pb0 mb15 mt15">
                    <div class="row">
                        <div class="col">
                            <h3 class="htxt_medium_14 dark_600">SMS channel</h3>
                        </div>
                        <div class="col text-right">
                            <p class="fsize14 dark_600 m-0">Active &nbsp; &nbsp;
                                <label class="custom-form-switch mt-0">
                                    <input class="field" type="checkbox" checked >
                                    <span class="toggle green3"></span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <div class="card p35 br6 mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">1</span></div>
                                <div class="col">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">From</h3>
                                    <p class="htxt_regular_14 dark_400 m-0 ls4">Who is sending this review request?</p>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Add sender</button>
                                </div>
                            </div>
                        </div>



                        <div class="card p35 br6 mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">2</span></div>
                                <div class="col">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">Content</h3>
                                    <p class="htxt_regular_14 dark_400 m-0 ls4">Customize the content of your email.</p>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit content</button>
                                </div>
                            </div>
                        </div>

                        <div class="card p35 br6 mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">3</span></div>
                                <div class="col">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">Settings & Tracking</h3>
                                    <p class="htxt_regular_14 dark_400 m-0 ls4">Customize your default campaign’s settings</p>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit Settings</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>






            </div>

        </div>

        <!--Content Area End-->
    </div>
</template>
<script>
    export default {
        data() {
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                fromNumber: '',
                displayCustomLinkExpiry: false
            }
        },
        created() {
            axios.get('/admin/brandboost/onsite_setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.brandboostData;
                    this.feedbackResponse = response.data.feedbackResponse;
                    //this.fromNumber = this.mobileNoFormat(response.data.fromNumber);
                    this.fromNumber = this.mobileNoFormat(this.feedbackResponse.sms_sender);
                    this.user = response.data.aUserInfo;
                    this.loading = false;
                    //loadJQScript(this.user.id);
                });
        },
        mounted() {
            //loadJQScript(35);
        },
        computed: {
            checkLinkExpiry: function(){
                let linkExpiry = this.campaign.link_expire_custom;
                if(linkExpiry){
                    let delayValue = '';
                    let delayUnit = '';
                    if( typeof linkExpiry === 'object'){
                        let aExpiryData = JSON.parse(linkExpiry);
                        delayValue = aExpiryData.delay_value;
                        delayUnit = aExpiryData.delay_unit;
                    }else{
                        delayValue = linkExpiry;
                    }

                    if(delayValue != 'never'){
                        this.displayCustomLinkExpiry = true;
                    }else{
                        this.displayCustomLinkExpiry = false;
                    }
                    return {
                        delay_unit: delayUnit,
                        delay_value: delayValue != 'never' ? delayValue : 'never'
                    };
                }else{
                    return {
                        delay_unit: '',
                        delay_value: 'never'
                    };
                }
            }
        },
        methods: {
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/reviews/onsite';
                }else{
                    path = '/admin#/reviews/onsite/setup/'+this.campaignId+'/'+step;
                }
                window.location.href = path;
            },
            applyDefaultInfo: function (e) {
                if (e.target.checked) {
                    this.campaign.from_email = this.user.email;
                    this.campaign.from_name = this.user.firstname + ' ' + this.user.lastname;
                    this.updateSettings('from_email');
                    this.updateSettings('from_name');
                }
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
                    //linkExpiryData :{delay_value: this.checkLinkExpiry.delay_value,delay_unit: this.checkLinkExpiry.delay_unit},
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
    function loadJQScript(userid){
        alert('I am called');
        var tkn = $('meta[name="_token"]').attr('content');
        Dropzone.autoDiscover = false;
        var myDropzoneLogoImg = new Dropzone(
            '#myDropzone_logo_img', //id of drop zone element 1
            {
                url: '/dropzone/upload_s3_attachment/'+userid+'/onsite',
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 600,
                acceptedFiles: 'image/*',
                addRemoveLinks: false,
                success: function (response) {
                    if (response.xhr.responseText != "") {
                        $('#showLogoImage').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/' + response.xhr.responseText).show();
                        var dropImage = $('#logo_img').val();
                        $.ajax({
                            url: "/admin/brandboost/DeleteObjectFromS3",
                            type: "POST",
                            data: {dropImage: dropImage, _token: tkn},
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                            }
                        });
                        $('#logo_img').val(response.xhr.responseText);
                        $('#logo_img').click();
                    }
                }
            });
        myDropzoneLogoImg.on("complete", function (file) {
            myDropzoneLogoImg.removeFile(file);
        });
    }
</script>
<style scoped>
    .email_config_list li{
        width: 19.5% !important;
    }
    .bkg_green {
        background: #4ebc86!important;
        background-color: #4ebc86!important;
    }
    .alert.preview {
        padding: 20px 25px!important;
        border-radius: 5px;
    }
    .txt_white {
        color: #ffffff!important;
    }
    .media-left, .media > .pull-left {
        padding-right: 20px;
        position: relative;
        display: table-cell;
    }
    .alert.preview img {
        margin-top: 8px;
        opacity: 0.5;
    }
    .bkg_dark {
        background: #202040!important;
        background-color: #202040!important;
    }
    .bkg_red {
        background: #eb4f76!important;
        background-color: #eb4f76!important;
    }
    .dropzone .dz-default.dz-message:before { content: ''!important; }
    .dropzone {min-height:32px !important; opacity:0;height:32px; }
    .dropzone .dz-default.dz-message{ top: 0%!important; height:40px;  margin-top:0px;}
    .dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
    .img_vid_upload_small{width: 100%; min-height: 50px; border-radius: 5px; background:url('/assets/images/upload_bkg2.png') 25px 8px no-repeat #fff; border: 1px solid #dfe5f0;box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.04);}
</style>
