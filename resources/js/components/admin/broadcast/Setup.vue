<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{this.campaign.title}}</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right d-none">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="/assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 slidebox">Main Action <span><img src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
            <loading :isLoading="loading"></loading>
            <div class="container-fluid">

                <div class="table_head_action bbot pb30">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="import_list">
                                <li><a class="active" href="#">Basic campaign info</a></li>
                                <li><a class="" href="#">Content & Design</a></li>
                                <li><a class="" href="#">Recipients</a></li>
                                <li><a href="#">Review & confirm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="row mt30">
                    <div class="col-md-9">
                        <div class="card p40 min_h_240">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Subject</h3>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="fname" class="fsize12 fw300">This text will be displayed in the ‘Subject’ field in your recepient’s email client.</label>
                                        <input type="text" class="form-control emoji h50" placeholder="Default subject" name="subject" v-model="campaign.subject" @change="updatesettings('subject')">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname" class="fsize12 fw300">&nbsp;</label>

                                        <select class="form-control h50">
                                            <option>Personalize</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb10"><hr></div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Sender info</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <h3 class="dark_400 mb0 fsize14 fw300">Default info &nbsp; <label class="custom-form-switch">
                                        <input class="field" type="checkbox" @click="applyDefaultInfo">
                                        <span class="toggle blue"></span>
                                    </label></h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname" class="fsize12 fw300">This will be displayed in the ‘From’ field.</label>
                                        <input type="text" class="form-control form-control-dark h50" placeholder="Max Iver" name="from_name" v-model="campaign.from_name" @change="updatesettings('from_name')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname" class="fsize12 fw300">&nbsp;</label>
                                        <input type="text" class="form-control form-control-dark h50" id="frmEmail" placeholder="alen@brandboost.io" name="from_email" v-model="campaign.from_email" @change="updatesettings('from_email')">
                                    </div>
                                </div>
                                <div class="col-md-12 mb10"><hr></div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="htxt_bold_16 dark_700 mb10">Reply Management</h3>
                                    <p class="fsize12 fw300 dark_500 mb20">Capture & foreward reply from your customers.</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <h3 class="dark_400 mb0 fsize14 fw300">Reply tracking &nbsp; <label class="custom-form-switch">
                                        <input class="field" type="checkbox" checked>
                                        <span class="toggle blue"></span>
                                    </label></h3>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="fname" class="fsize12 fw300">Forward-to address</label>
                                        <input type="text" class="form-control form-control-dark h50"
                                               placeholder="alen@brandboost.io" name="reply_to"
                                               v-model="campaign.reply_to"
                                               @change="updatesettings('reply_to')"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb0">
                                        <label for="fname" class="fsize12 fw300">Personalize “To-adress”</label>
                                        <input type="text" class="form-control form-control-dark h50" id="fname" placeholder="Include recepient’s name in “To”" name="fname">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-3">
                        <img src="/assets/images/information-line.svg"/>
                        <h3 class="fsize14 fw600 dark_700 mb10 mt10">Default info</h3>
                        <p class="fsize12 fw300 dark_300">Each subscriber should be on a new line. You can include any extra details such as name and age, and we'll match them up with your custom fields in the next step. Before you import your list, make sure it meets our permission policies.</p>
                    </div>

                </div>


                <div class="row mt40">
                    <div class="col-md-12"><hr class="mb25"></div>
                    <div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"> <span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button></div>
                    <div class="col-6"><button class="btn btn-sm bkg_blue_200 light_000 float-right">Save and continue <span><img src="/assets/images/arrow-right-line.svg"></span></button></div>
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
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId : this.$route.params.id,
                campaign: {},
                user: {},
                breadcrumb: '',
            }
        },
        mounted() {
            axios.get('/admin/broadcast/setup/'+this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oBroadcast;
                    this.user = response.data.userData;
                    this.loading = false;
                });
        },
        methods: {
            applyDefaultInfo : function(e){
                if(e.target.checked){
                    this.campaign.from_email = this.user.email;
                    this.campaign.from_name = this.user.firstname+ ' ' + this.user.lastname;
                    this.updatesettings('from_email');
                    this.updatesettings('from_name');
                }else{

                }
            },
            updatesettings: function(fieldName){
                this.loading = true;
                axios.post('/admin/broadcast/updateBroadcastSettingUnit', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal:this.campaign[fieldName],
                    event_id : this.campaign.event_id,
                    campaign_id: this.campaign.id,
                    broadcast_id: this.campaign.broadcast_id
                }).then(response => {
                    this.successMsg = 'Updated the changes successfully!!'
                    this.loading = false;
                });

            }
        }

    };

</script>



