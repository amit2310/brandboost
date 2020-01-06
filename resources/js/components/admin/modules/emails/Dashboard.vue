<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Email Dashboard</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/emailfilter.svg"/></button>
                        <button class="btn btn-md light_000 bkg_email_300 slidebox">Create new <span style="opacity: 0.3"><img
                            src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card min-h-280">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="htxt_medium_32 dark_700">79,3%</h3>
                                    <p class="grey-sub-headings">YOUR EMAIL MARKETING IS GOOD</p>
                                    <hr>
                                    <p class="fsize14 mb30" style="color: #5a6f80;">Your recent emails have low avg. 9%
                                        bounce rate. We suggest you to send new email
                                        in next 3 days.</p>
                                    <a class="fsize15 email_400" href="#"><img src="/assets/images/emailedit.svg"/>&nbsp;
                                        Create new email</a>
                                </div>
                                <div class="col-md-6 text-center">
                                    <img class="" style="max-width: 225px; "
                                         src="/assets/images/email_dashboard_illustration.png" />
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card min-h-280 p0 text-center">
                            <div class="p20 mb10">
                                <img class="mb20" style="max-width: 130px; margin: 0 auto"
                                     src="/assets/images/dashboard_graph0.png"/>
                                <p class="grey-sub-headings mb10">CREDITS BALANCE</p>
                                <p class="fsize14 mb10" style="color: #5a6f80;">You used 408/450 montly credits</p>
                            </div>
                            <div class="p15 btop">
                                <a class="fsize15 fw500 email_400 mt20" href="#">Purchase more credits</a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card min-h-280 p0 col">
                            <div class="p15 pl40 bbot">
                                <a class="fsize12 dark_200" href="#">EMAILS SENT</a>
                            </div>
                            <div class="p30 pl40">
                                <h3 class="htxt_medium_24 dark_700 mb10">51,913</h3>
                                <p class="fsize14"><span class="green_400">33,87%</span> &nbsp; <span class="dark_400">last month</span>
                                </p>
                                <img src="/assets/images/email_graph2.png"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="card min-h-280 col">
                            <h3 class="htxt_medium_32 dark_700">139</h3>
                            <p class="grey-sub-headings">Subscriptions</p>
                            <img class="mt-5" src="/assets/images/email_graph.png"/>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <!--Content Area End-->

        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
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
    export default {
        data(){
            return {
                breadcrumb: {
                    'Home': '#/',
                    'Email': '#/modules/emails/dashboard',
                    'Dashboard': ''
                }
            }
        },
        mounted() {
            this.makeBreadcrumb(this.breadcrumb);
        }
    }
</script>



