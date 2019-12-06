<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">SMS Dashboard</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="mr15 btn btn-md bkg_light_000 sms_400">Filters &nbsp; &nbsp; <img src="assets/images/sms_filter.svg"/></button>
                        <button class="btn btn-md light_000 bkg_sms_400 slidebox" >New campaign &nbsp; &nbsp; <span><img src="assets/images/sms_add.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 d-flex">
                        <div class="card col">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="htxt_medium_32 dark_700">79.3%</h3>
                                    <p class="grey-sub-headings">YOUR SMS MARKETING IS GOOD</p>
                                    <hr>
                                    <p class="fsize14 mb30 dark_300" style="max-width: 316px;">Your recent emails have low avg. 9% bounce rate. We suggest you to send new email in next 3 days.</p>
                                    <button class="btn btn-md bkg_sms_000 sms_400 pr20">Create SMS</button>
                                </div>
                                <div class="col-md-6 text-center">
                                    <img class="" style="max-height: 210px; " src="assets/images/sms_dashboard1.svg"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card p0 text-center col">
                            <div class="p20 mb10">
                                <img class="mb20" style="max-width: 130px; margin: 0 auto" src="/assets/images/dashboard_graph0.png"/>
                                <!--<div id="credit_chart" style="max-height: 135px;">
                                    <apexchart type=radialBar height=200 :options="chartOptions3" :series="series" />
                                </div>-->
                                <p class="fsize14 mb10 mt20 dark_300">You used 408/450 montly credits</p>
                            </div>
                            <div class="p20 btop">
                                <a class="fsize14 fw500 sms_400 mt20" href="#">Purchase more credits</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card min-h-280 p0 col">
                            <div class="p15 pl40 bbot">
                                <a class="fsize12 dark_200" href="#">SMS SENT</a>
                            </div>
                            <div class="p30 pl40 pb0">
                                <h3 class="htxt_medium_24 dark_700 mb10">51,913</h3>
                                <p class="fsize14"><span class="green_400">33.87%</span> &nbsp;  <span class="dark_400">last month</span></p>
                                <img  src="assets/images/email_graph2.png"/>
                                <!--<div id="basiclinechart" style="margin-left: -20px">
                                    <apexchart type=line height=240 :options="chartOptions2" :series="series" />
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="card col pb0">
                            <h3 class="htxt_medium_32 dark_700">139</h3>
                            <p class="grey-sub-headings">Subscriptions</p>
                            <img class="mt-5" src="assets/images/email_graph.png"/>
                            <!--<div id="chartSubscriptions" style="margin-left: -20px; margin-top: 50px;">
                                <apexchart type=bar height=220 :options="chartOptions" :series="series" />
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->

        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="/assets/images/email_campaign_icon.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Create SMS Campaign </h3>
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
                                                        <p class="fsize12 fw300 dark_200 m0">Simple one time sms</p>
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
                                                        <p class="fsize16 fw400 dark_700 m0">SMS workflows</p>
                                                        <p class="fsize12 fw300 dark_200 m0">Simple one time sms</p>
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
                                                        <p class="fsize16 fw400 dark_700 m0">Transactional sms</p>
                                                        <p class="fsize12 fw300 dark_200 m0">Send automated transactional sms</p>
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
                    'SMS': '#/modules/sms/dashboard',
                    'Dashboard': ''
                }
            }
        },
        mounted() {
            this.makeBreadcrumb(this.breadcrumb);
        }
    }
</script>
