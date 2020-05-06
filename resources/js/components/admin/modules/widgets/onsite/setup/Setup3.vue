<template>
    <div class="content">
        <!--****************** Top Heading area  **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">On Site Widget Setup
                            <!--                            {{campaign.brand_title}} -->
                        </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.bc_status !='archive'" @click="saveDraft"> Save as draft</button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(4)"> Next <span style="opacity: 1"><img
                            src="/assets/images/arrow-right-line-white.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--****************** Content area *********************-->
        <div class="content-area">
            <div class="container-fluid">
                <div class="table_head_action">
                    <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
                    <loading :isLoading="loading"></loading>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="email_config_list">
                                <li><a href="javascript:void(0);" @click="displayStep(1)"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Review Widgets</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration</a></li>
                                <li><a class="active"  href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Statistics</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading p15">
                                <h6 class="panel-title">How to add widget</h6>
                            </div>
                            <div class="panel-body p15">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item br0"  src="https://www.youtube.com/embed/2H_Jsgh2Z3Y?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div style="margin: 0;" class="panel panel-flat ">
                            <div class="panel-heading p15">
                                <h6 class="panel-title">You’re All Set!</h6>
                            </div>
                            <div class="panel-body min_h270 p20">
                                <p><span class="txt_dark">Descriptions List</span><br><small class="text-muted text-size-small">So strongly and metaphysically did I conceive of my situati.</small></p>
                                <p><span class="txt_dark">Euismod</span><br><small class="text-muted text-size-small">In the tumultuous business of cutting-in and attending to a whale, there.</small></p>
                                <p><span class="txt_dark">Descriptions List</span><br><small class="text-muted text-size-small">So strongly and metaphysically did I conceive of my situati.</small></p>
                                <p><span class="txt_dark">Euismod</span><br><small class="text-muted text-size-small">In the tumultuous business of cutting-in and attending to a whale, there.</small></p>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading p15">
                                <h6 class="panel-title">Embedded Code</h6>
                            </div>
                            <div class="panel-body min_h270 p15">
                                <div class="bbot">
                                 <pre class="prettyprint p0">&lt;script
        type='text/javascript'
        id='bbscriptloader' data-key='{{campaign.hashcode}}'
        data-widgets='bfw'
        async=''
        src='http://brandboost.io/assets/js/widgets.js' &gt;

    &lt;/script&gt;
                                        </pre>
                                    <div style="display: none;" class="prettyprintDiv">&lt;script type='text/javascript' id='bbscriptloader' data-key='{{campaign.hashcode}}; ?>' data-widgets='chat' async='' src='http://brandboost.io/assets/js/widgets.js' &gt; &lt;/script&gt;</div>
                                </div>
                                <div class="p20 text-right">
                                    <button class="btn btn-xs btn_white_table pl10 pr10" id="btnCopyWidget" onclick="copyToClipboard('.prettyprintDiv')">Copy Code</button>
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
        title: 'Onsite Widgets - Brand Boost',

        data() {
            return {
                refreshMessage: 1,


                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                widget_type: '',
                campaignId: this.$route.params.id,
                campaign: {},
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                fromNumber: '',
                displayCustomLinkExpiry: false
            }
        },

        mounted() {
            this.widgetID = this.$route.params.id;
            this.widget_type = this.$route.params.id;
            this.getWidgetDetails()
            // loadJQScript(35);
        },
        computed: {
            checkLinkExpiry: function(){
                let linkExpiry = this.campaign.link_expire_custom;
                if(linkExpiry){
                    let aExpiryData = JSON.parse(linkExpiry);
                    let delayValue = aExpiryData.delay_value;
                    let delayUnit = aExpiryData.delay_unit;
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
            setWidgetType:function(){
                this.loading =true;
                axios.post('/admin/brandboost/set-widget-type',{
                    widgetID: this.$route.params.id,
                    widgetTypeID: this.campaign.widget_type,
                }).then(response => {
                    // console.log(response.data.status);
                    this.getWidgetDetails();
                    if(response.data.status =='success'){
                        this.displayMessage('success', 'Setting has beeb saved successfully.');
                    }
                    this.loading =false;
                });
            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/widgets/onsite';
                }else{
                    if(step == 4){
                        path = '/admin#/widgets/onsite/stats/'+this.campaignId+'/'+step;
                    }else{
                        path = '/admin#/widgets/onsite/setup/'+this.campaignId+'/'+step;
                    }

                }

                window.location.href = path;
            },
            getWidgetDetails: function () {

                axios.get('/admin/brandboost/onsite-widget-setup/' + this.campaignId)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.oWidgets = response.data.oWidgets;
                        this.bActiveSubsription = response.data.bActiveSubsription;
                        this.campaign = response.data.widgetData;
                        this.oBrandboostList = response.data.oBrandboostList;
                        this.oStats = response.data.oStats;
                        this.setTab = response.data.setTab;
                        this.widgetID = response.data.widgetID;
                        this.widgetThemeData = response.data.widgetThemeData;
                        this.selectedTab = response.data.selectedTab;
                        this.widget_preview = response.data.widget_preview;

                        this.loading = false;

                    });
            },
            applyDefaultInfo: function (e) {
                if (e.target.checked) {
                    this.campaign.from_email = this.user.email;
                    this.campaign.from_name = this.user.firstname + ' ' + this.user.lastname;
                    this.updateSettings('from_email');
                    this.updateSettings('from_name');
                } else {

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
                    requestType: type

                }).then(response => {

                    this.displayMessage('success', 'Test email sent successfully!');
                    this.loading = false;
                });

            },
            saveDraft: function(){
                this.loading = true;
                axios.post('/admin/brandboost/updateOnsiteStatus', {
                    brandboostID: this.campaignId,
                    status: '3',
                    current_state: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if(response.data.status == 'success'){
                            this.displayMessage('success', 'Campaign saved as a draft successfully');
                        }else{
                            this.displayMessage('error', 'Something went wrong');
                        }
                    });
            }

        }
    }
    function loadJQScript(userid){
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
    .review_source_new .inner {
        text-align: center;
        border-radius: 5px;
        box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
        background-color: #ffffff;
        /* border: solid 1px #e3e9f3; */
        min-height: 248px;
        position: relative;
        padding: 15px;
    }
    .review_source_new .custmo_checkbox.checkboxs {
        position: absolute;
        width: 17px;
        right: 5px!important;
        top: 11px;
        z-index: 9;
        display: inline-block;
    }
    .custmo_checkbox {
        display: block;
        position: relative;
        padding-left: 18px;
        margin-bottom: 0px;
        cursor: pointer;
        font-size: 13px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        line-height: 17px;
        height: 17px;

    }
    .custmo_checkmark{
        border-radius: 10px;
        border: 1px solid #FFF !important;
    }
    .col-md-2.review_source_new .inner {
        text-align: center;
        border-radius: 5px;
        box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
        background-color: #ffffff;
        /* border: solid 1px #e3e9f3; */
        min-height: 200px;
        position: relative;
        padding: 15px;
    }
    .col-md-2.review_source_new .inner.active {
        border: 1px solid #9986e4!important;
    }
    .col-md-2.review_source_new .inner .text_sec p {
        margin-bottom: 5px;
    }
    .col-md-2.review_source_new .inner .text_sec h5 {
        font-size: 12px;
        font-weight: 300 !important;
        color: #5e729d;
        line-height: 1.33;
        margin: 0;
    }
</style>




