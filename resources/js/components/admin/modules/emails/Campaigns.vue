<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Email Campaigns</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/emailfilter.svg"/></button>
                        <button class="btn btn-md bkg_email_300 light_000 js-email-campaign-slidebox"> New campaign <span style="opacity: 0.3"><img src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
            <loading :isLoading="loading"></loading>
            <div class="container-fluid" v-if="campaigns==''">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 email_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_email_000 mr10"><img src="/assets/images/download-fill-email.svg"/></span>
                                        Import campaign
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="/assets/images/question-line.svg"/></span>
                                        Learn how to use segments
                                    </a>
                                </div>
                            </div>


                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="/assets/images/email_illustration.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No campaigns yet. Create a first one!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or create email campaign!</h3>
                                    <button class="btn btn-sm bkg_email_000 pr20 email_400 js-email-campaign-slidebox">Create email campaign</button>
                                </div>
                            </div>






                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" v-else>
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">Email Campaigns</h3>
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
                                        <span><img src="assets/images/list_view.svg"></span>&nbsp; Cards
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Serch">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-3" v-for="campaign in campaigns" :key="campaign.id">
                        <div class="card p0 pt30 min_h_275 text-center animate_top">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                    <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> Active</a>
                                    <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Move to Archive</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Delete</a></div>
                            </div>

                            <a href="#" class="circle-icon-64 bkg_email_000 m0auto" v-if="campaign.status='active'"><img src="assets/images/send-plane-fill-email_blue.svg"/> </a>
                            <a href="#" class="circle-icon-64 bkg_dark_000 m0auto" v-else><img src="assets/images/send-plane-fill-grey.svg"> </a>
                            <h3 class="htxt_bold_16 dark_700 mb-1 mt-4" :title="capitalizeFirstLetter(campaign.title)">{{setStringLimit(capitalizeFirstLetter(campaign.title), 15)}}</h3>
                            <p class="fsize11 fw500 dark_200 text-uppercase">Campaign</p>
                            <div style="min-height: 40px; margin: 4px 0;" class="img_box">
                                <img src="assets/images/email_campaign_graph.png"/>
                            </div>

                            <div class="p15 pt15 btop">
                                <ul class="workflow_list">
                                    <li><a href="#"><span><img src="assets/images/send-plane-line.svg"></span> {{campaign.stats.sent_total>999 ? (campaign.stats.sent_total/100)+'k' : campaign.stats.sent_total}}</a></li>
                                    <li><a href="#"><span><img src="assets/images/mail-open-line.svg"></span> {{campaign.stats.open_rate}}%</a></li>
                                    <li><a href="#"><span><img src="assets/images/cursor-line.svg"></span> {{campaign.stats.click_rate}}%</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="card p30 min_h_275 animate_top">
                            <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                            <p class="htxt_regular_16 dark_100 mb15">Create<br>contacts list</p>
                        </div>
                    </div>
                </div>

                <pagination
                    :pagination="allData"
                    @paginate="showPaginationData"
                    :offset="4">
                </pagination>


            </div>

        </div>
        <!--Content Area End-->

        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-email-campaign-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="/assets/images/email_campaign_icon.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Create Email Campaign </h3>
                                <hr class="mt30 mb30">
                            </div>
                            <div class="col-md-12">
                                <form action="/action_page.php">
                                    <div class="form-group">
                                        <label for="campaignname">Campaign name</label>
                                        <input type="text" class="form-control h56" id="campaignname" placeholder="Enter campaign name" name="campaignname">
                                    </div>

                                    <div class="form-group">
                                        <label for="Category">Category</label>
                                        <input type="text" class="form-control h56" id="Category" placeholder="No category..." name="Category">
                                    </div>

                                    <hr class="mt30 mb30"/>


                                    <div class="form-group">
                                        <label class="mb10">Campaign type</label>
                                        <div class="clearfix"></div>


                                        <label class="w-100 mb0" for="Broadcast_campaign">
                                            <div class="card border active  shadow_none p20">
                                                <div class="row">
                                                    <div class="col-md-3"><img src="/assets/images/campaign1.svg"/></div>
                                                    <div class="col-md-9 pl0">
                                                        <p class="fsize16 fw400 dark_700 m0">Broadcast</p>
                                                        <p class="fsize12 fw300 dark_200 m0">Simple one time emails</p>
                                                    </div>
                                                </div>


                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="Broadcast_campaign" name="rad1" >
                                                    <label class="custom-control-label" for="customRadio"></label>
                                                </div>



                                            </div>
                                        </label>



                                        <label class="w-100 mb0" for="Emailworkflows">
                                            <div class="card border shadow_none p20">
                                                <div class="row">
                                                    <div class="col-md-3"><img src="/assets/images/campaign2.svg"/></div>
                                                    <div class="col-md-9 pl0">
                                                        <p class="fsize16 fw400 dark_700 m0">Email workflows</p>
                                                        <p class="fsize12 fw300 dark_200 m0">Simple one time emails</p>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="Emailworkflows" name="rad1" >
                                                    <label class="custom-control-label" for="customRadio"></label>
                                                </div>
                                            </div>
                                        </label>



                                        <label class="w-100 mb0" for="Transactionalemails">
                                            <div class="card border shadow_none p20">
                                                <div class="row">
                                                    <div class="col-md-3"><img src="/assets/images/campaign3.svg"/></div>
                                                    <div class="col-md-9 pl0">
                                                        <p class="fsize16 fw400 dark_700 m0">Transactional emails</p>
                                                        <p class="fsize12 fw300 dark_200 m0">Send automated transactional emails</p>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="Transactionalemails" name="rad1" >
                                                    <label class="custom-control-label" for="customRadio"></label>
                                                </div>
                                            </div>
                                        </label>


                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-lg bkg_email_400 light_000 pr20 min_w_160 fsize16 fw600">Create</button>
                                <a class="dark_200 fsize16 fw400 ml20" href="#">Close</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Pagination from '../../../helpers/Pagination';
    export default {
        components: {Pagination},
        data() {
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaigns: {},
                allData: {},
                current_page: 1,
                breadcrumb: '',
                form: {
                    firstname: '',
                    lastname: '',
                    email: '',
                    phone: '',
                    id: ''
                },
                formLabel: 'Create'
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-contact-slidebox').click();
            },
            processForm : function(){
                this.loading = true;
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.id>0){
                    formActionSrc = '/admin/subscriber/update_contact';
                }else{
                    formActionSrc = '/admin/subscriber/add_contact';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.loading = false;
                            //this.form = {};
                            this.form.id ='';
                            document.querySelector('.js-contact-slidebox').click();
                            this.successMsg = 'Action completed successfully.';
                            var elem = this;
                            setTimeout(function () {
                                elem.loadPaginatedData();
                            }, 500);

                            syncContactSelectionSources();
                        }
                    })
                    .catch(error => {
                        this.loading = false;
                        console.log(error);
                        //error.response.data
                        //alert('All form fields are required');
                    });
            },
            loadPaginatedData : function(){
                axios.get('/admin/modules/emails/?page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaigns = response.data.oAutomations;
                        this.allData = response.data.allData;
                        this.loading = false;
                    });
            },
            showPaginationData: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },

            addNewContact : function(e){
                //e.preventDefault();
                let form = document.getElementById('addNewContactVue');
                let formData = new FormData(form);
                formData.append('_token', this.csrf_token());
                axios.post('/admin/subscriber/add_contact', this)
                    .then(response => {
                        if(response.data.status == 'success'){
                            alert(('form submitted successfully'))
                            /*vm.$forceUpdate();*/
                        }

                    });
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            }
        }

    };

    $(document).ready(function () {
        $(document).on('click', '.js-email-campaign-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

    });
</script>



