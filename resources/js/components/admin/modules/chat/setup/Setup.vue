<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{campaign.title}} </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.status !='archive'" @click="changeCampaignStatus('draft')"> Save as draft</button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(2)"> Next <span style="opacity: 1"><img
                            src="/assets/images/arrow-right-line-white.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">

            <loading :isLoading="loading"></loading>

            <div class="container-fluid">
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="email_config_list">
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Campaign info</a></li>
<!--                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">1</span><span-->
<!--                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Campaign info</a></li>-->
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="email_review_config p20">
                            <div class="bbot pb10 mb15">
                                <p class="fsize11 text-uppercase dark_200 m-0">Availability</p>
                            </div>
                            <div class="p0">
                                <div class="form-group">
                                    <h3 v-if="campaign.platform !='sms'" class="dark_400 mb0 fsize13 fw300">Set working hours
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="campaign.company_info" :checked="campaign.company_info" @change="synCompanyInfo($event)">
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                </div>
                            </div>
                            <div class="p0 ">
                                <div class="form-group">
                                    <label class="fsize12" for="from_name">Review Request "Form" Name:</label>
                                    <input type="text" v-model="campaign.from_name" class="form-control h40" id="from_name" placeholder="Mr Anderson" name="brand_name">
                                </div>
                            </div>
                            <div class="p0 ">
                                <div class="form-group">
                                    <label class="fsize12" for="from_email">Review Request "Form" Email:</label>
                                    <input type="text" v-model="campaign.from_email" class="form-control h40" id="from_email" placeholder="umair@nethues.com" name="from_email">
                                </div>
                            </div>
                            <div class="p0 ">
                                <div class="form-group">
                                    <label class="fsize12" for="sender_name">SMS Sender Name:</label>
                                    <input type="text" v-model="campaign.sender_name" class="form-control h40" id="sender_name" placeholder="Mr Anderson" name="sender_name">
                                </div>
                            </div>
                            <div class="p0 bbot">
                                <div class="form-group">
                                    <label class="fsize12" for="sender_name">Review Request Language:</label>
                                    <select class="form-control">
                                        <option>English (USA)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="p0 bbot">
                                <div class="form-group">
                                    <div class="">
                                        <label class="custmo_radiobox pull-left mr-20">
                                            <input type="radio" name="rad13" checked="">
                                            <span class="custmo_radiomark"></span>
                                            Happy Ratings
                                        </label>
                                        <br/>
                                        <br/>
                                        <label class="custmo_radiobox pull-left">
                                            <input type="radio" name="rad13">
                                            <span class="custmo_radiomark"></span>
                                            Star Ratings
                                        </label>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="p0 bbot">
                                <div class="form-group">
                                    <br/>
                                    <div class="p5">
                                        <a class="mr10" href="#"><img src="/assets/images/yello_smile1.png"></a>
                                        <a class="mr10" href="#"><img src="/assets/images/yello_smile2.png"></a>
                                        <a class="mr10" href="#"><img src="/assets/images/yello_smile3.png"></a>
                                        <a class="mr10" href="#"><img src="/assets/images/yello_smile4.png"></a>
                                        <a class="mr10" href="#"><img src="/assets/images/yello_smile5.png"></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="email_review_config  p20">
                            <div class="bbot pb10 mb15">
                                <p class="fsize11 text-uppercase dark_200 m-0">Automation</p>
                            </div>
                            <div class="p0">
                                <div class="form-group">
                                    <h3 v-if="campaign.platform !='sms'" class="dark_400 mb0 fsize13 fw300">Activite automated messages
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="campaign.automated_message" :checked="campaign.automated_message" @change="synAutomatedMessage($event)">
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                            <div class="panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i><img src="/assets/images/time-fill-grey.svg"/></i>GREETING
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="inputArea" v-for="(msgsec, index) in message_sec">
                                            <div class="sec-wrap">
                                                <div class="p0 ">
                                                    <div class="form-group">
                                                        <label class="fsize12">Message:</label>
                                                        <textarea class="form-control"  v-model="msgsec.message"
                                                                  placeholder="Hi! We are ready to help you. Ask us anything or share your feedback."></textarea>
                                                    </div>
                                                </div>
                                                <div class="p0 ">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="fsize12" for="from_name">Time:</label>
                                                                <input type="text" v-model="msgsec.time" class="form-control h40" id="time" placeholder="Wait for 5 sec" name="brand_name">
                                                            </div>
                                                            <div class="col-ms-6">
                                                                <br/>
                                                                <button type="button" class="btn white_btn ml20 h40 p10 removeMessage" v-if="index != 0 "  @click="removeMessageSec(index)"><i class="icon-minus3"></i></button>
                                                                <button type="button" class="btn white_btn ml20 h40 p10 addMessage" v-if="index == (message_sec.length-1) " @click="addMessageSec()"><i class="icon-plus3"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <br/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <i><img src="/assets/images/apps-2-fill.svg"/></i>After 120 sec.
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        Content Goes here...
                                    </div>
                                </div>

                            </div>

                            <div class="panel-default">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            <i><img src="/assets/images/palette-fill.svg"/></i>Open "About Us" page
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        Content Goes here...

                                    </div>
                                </div>
                            </div>
                            <div class="panel-default">
                                <div class="panel-heading" role="tab" id="headingFive">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            <i><img src="/assets/images/settings-2-fill.svg"/></i>Previous visits: 3
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                    <div class="panel-body">
                                        Content Goes here...

                                    </div>
                                </div>
                            </div>
                            <div class="panel-default">
                                <div class="panel-heading" role="tab" id="headingSix">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseFive">
                                            <i><img src="/assets/images/settings-2-fill.svg"/></i>Click button
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                    <div class="panel-body">
                                        Content Goes here...

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="email_review_config p20">
                            <div class="bbot pb10 mb15">
                                <p class="fsize11 text-uppercase dark_200 m-0">Inbound conversations</p>
                            </div>
                            <div class="bbot p0">
                                <div class="form-group">
                                    <h3 class="dark_400 mb0 fsize13 fw300">New Chat Button
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="campaign.chat_icon == '4'"  @change="synChatIcon($event)">
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                </div>
                            </div>
                            <div class="bbot p0">
                                <div class="form-group">
                                    <h3 class="dark_400 mb0 fsize13 fw300">Show Contact Details
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="campaign.contact_details_config" :checked="campaign.contact_details_config" @change="synContactDetailsConfig($event)">
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" v-show="true" @click="displayStep(0)"><span class="ml0 mr10"><img
                            src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(2)">Continue <span><img
                            src="/assets/images/arrow-right-line.svg"></span></button>
                        <button class="btn btn-success btn-sm bkg_green_300 light_000 float-right mr-3" @click="updateConfigurations">Save Changes <span><img
                            src="/assets/images/arrow-right-line.svg"></span></button>
                    </div>
                </div>

            </div>
        </div>
        <!--Content Area End-->
    </div>
</template>
<script>
    import jq from 'jquery';
    export default {
        data() {
            return {
                counter: 0,
                message_sec: [{
                    message: '',
                    time: '',
                }],
                refreshMessage: 1,


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
                displayCustomLinkExpiry: false,
                preview: ''
            }
        },
        created() {
            axios.get('/admin/modules/chat/setup/' + this.campaignId)
                .then(response => {
                    // this.breadcrumb = response.data.breadcrumb;
                    // this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oChat;
                    this.message_sec =this.campaign.messages;
                    this.preview = response.data.setupPreview;
                    this.user = response.data.userData;
                    this.loading = false;

                });
        },
        mounted() {
            setTimeout(function(){
                loadNPSJQScript(35);
            }, 500);

        },
        computed: {

        },
        watch :{
            selectChatIcon : function () {
                if(this.campaign.chat_icon == 4){
                    return true;
                }else{
                    return false;
                }
            }
        },
        methods: {
            addMessageSec: function(){
                this.message_sec.push({
                    message: '',
                    time: '',
                });
            },
            removeMessageSec: function(index){
                this.message_sec.splice(index, 1);
            },
            synCompanyInfo: function(e){
                if(e.target.checked){
                    this.updateSingleField('company_info',1);

                }else{
                    this.updateSingleField('company_info',0);
                }
            },
            synAutomatedMessage: function(e){
                if(e.target.checked){
                    this.updateSingleField('automated_message',1);

                }else{
                    this.updateSingleField('automated_message',0);
                }
            },
            synChatIcon: function(e){
                if(e.target.checked){
                    this.updateSingleField('chat_icon',4);

                }else{
                    this.updateSingleField('chat_icon',3);
                }
            },
            synContactDetailsConfig: function(e){
                if(e.target.checked){
                    this.updateSingleField('contact_details_config',1);

                }else{
                    this.updateSingleField('contact_details_config',0);
                }
            },
            toggleQuestionDisplay: function(e){
                if(e.target.checked){
                    jq(".questionText").show();
                    jq(".questionEamilText").show();
                }else{
                    jq(".questionText").hide();
                    jq(".questionEamilText").hide();
                }
            },
            toggleIntroDisplay: function(e){
                if(e.target.checked){
                    jq(".introductionText").show();
                }else{
                    jq(".introductionText").hide();
                }
            },
            syncQuestion: function(){
                document.querySelector('.questionEamilText').innerHTML=this.campaign.question;
                document.querySelector('.questionText').innerHTML=this.campaign.question;
                document.querySelector('.questionSMSText').innerHTML=this.campaign.question + '<br><br>Please Reply with a number from "0" (not likely) to "10" (very likely)';
            },
            syncIntro: function(){
                document.querySelector('.introductionText').innerHTML=this.campaign.description;

            },
            updateConfigurations: function(){
                this.loading = true;
                //Grab color related values
                // this.campaign.from_email = this.campaign.from_email;
                // this.campaign.from_name = this.campaign.from_name;
                this.campaign.messages =this.message_sec;
                axios.post('/admin/modules/chat/updateChatWidgetInfo', this.campaign)
                    .then(response => {
                        this.loading = false;
                    });

            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/modules/chat/';
                }else{
                    path = '/admin#/modules/chat/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
            },

            updateSingleField: function (fieldName, fieldValue) {
                this.loading = true;
                axios.post('admin/modules/chat/updateSingleField', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    chatID: this.campaignId,
                }).then(response => {

                    this.displayMessage('success', 'Test email sent successfully!');
                    this.loading = false;
                });

            },
            changeCampaignStatus: function(status){
                this.loading = true;
                axios.post('/admin/modules/chat/changeStatus', {
                    chatID: this.campaignId,
                    status: status,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if(response.data.status == 'success'){
                            if(status == 'draft'){
                                this.displayMessage('success', 'Chat Widget saved as a draft successfully');
                            }
                            if(status == 'active'){
                                this.displayMessage('success', 'Chat Widget is active now');
                            }

                        }else{
                            this.displayMessage('error', 'Something went wrong');
                        }
                    });
            }
        }

    };

    function loadNPSJQScript(userid){
        var tkn = $('meta[name="_token"]').attr('content');
        /*$(".colorpicker-basic1").spectrum();
        $(".colorpicker-basic2").spectrum();
        $(".colorpicker-basic3").spectrum();
        $(".colorpicker-basic4").spectrum();*/

        $(".colorpicker-basic1").spectrum({
            change: function (color) {
            $('.colorpicker-basic1').val(color.toHexString());
            },
            move: function (color) {
                $('.colorpicker-basic1').val(color.toHexString());
            }
        });
        $(".colorpicker-basic2").spectrum({
            change: function (color) {
            $('.colorpicker-basic2').val(color.toHexString());
            },
            move: function (color) {
                $('.colorpicker-basic2').val(color.toHexString());
            }
        });
        $(".colorpicker-basic3").spectrum({
            change: function (color) {
            $('.colorpicker-basic3').val(color.toHexString());
            },
            move: function (color) {
                $('.colorpicker-basic3').val(color.toHexString());
            }
        });
        $(".colorpicker-basic4").spectrum({
            change: function (color) {
            $('.colorpicker-basic4').val(color.toHexString());
            },
            move: function (color) {
                $('.colorpicker-basic4').val(color.toHexString());
            }
        });



        var myDropzoneLogoImg = new Dropzone(
            '#uploadNPSBrandLogo', //id of drop zone element 1
            {
                url: 'dropzone/upload_s3_attachment/'+userid+'/nps',
                params: {
                    _token: tkn
                },
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 600,
                acceptedFiles: 'image/*',
                addRemoveLinks: false,
                success: function (response) {
                    if(response.xhr.responseText != "") {
                        $('.logo_img').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
                        var dropImage = $('#npsBrandLogo').val();
                        $.ajax({
                            url: '/admin/brandboost/DeleteObjectFromS3',
                            type: "POST",
                            data: {_token: tkn, dropImage: dropImage},
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                            }
                        });
                        $('#npsBrandLogo').val(response.xhr.responseText);
                    }
                }
            });
        myDropzoneLogoImg.on("complete", function(file) {
            myDropzoneLogoImg.removeFile(file);
        });
    }

</script>
<style scoped>
    .email_config_list li{
        width: 24.5% !important;
    }
    .email_review_config{
        width: 100%;
        position: relative !important;
    }
</style>



