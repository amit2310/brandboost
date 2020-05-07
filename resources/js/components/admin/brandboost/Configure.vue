<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{campaign.brand_title}}</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="btn btn-md bkg_light_800 light_000" :disabled="progressRate<100" :class="{'bkg_reviews_400': progressRate == 100}" @click.prevent="saveCampaign" >Save Campaign <span><img src="assets/images/arrow-right-circle-fill-white.svg"></span></button>
                        <button id="displayOverviewPreviewForm" type="button" style="display:none;">Display Edit & Preview Email</button>
                        <button id="hideOverviewPreviewForm" type="button" style="display:none;">Hide</button>
                        <button id="displaySMSPreviewForm" type="button" style="display:none;">Display Edit & Preview SMS</button>
                        <button id="hideSMSPreviewForm" type="button" style="display:none;">Hide</button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">
            <div class="container-fluid">

                <loading :isLoading="loading"></loading>
                <!--******************
                PAGE LEFT SIDEBAR
               **********************-->
                <a class="close_sidebar" href="javascript:void(0);">&nbsp; <img src="assets/images/menu-2-line.svg"></a>
                <div class="page_sidebar bkg_light_000 fixed">
                    <div style="width: 279px;">
                        <div class="p20 bbot top_headings">
                            <div class="row">
                                <div class="col"><p>Review Campaign</p></div>
                            </div>
                        </div>

                        <div class="p30 pb10 text-center">
                            <!--<img src="assets/images/review_setup_graph.svg"/>Progress: {{progressRate}}%-->
                            <div id="chart_07">
                            <apexchart type=radialBar height=170 :options="chartOptions" :series="series" />
                            </div>
                        </div>

                        <div class="p30 pb15">
                            <div class="row">
                                <div class="col-9">
                                    <p class="htxt_medium_12 dark_200 ls_4 m-0 ml20">EMAIL REQUESTS</p>
                                </div>
                                <div class="col-3">
                                    <label class="custom-form-switch mt-0 float-right">
                                        <input class="field" type="checkbox" :checked="isEmailChannelActivated" @change="isEmailChannelActivated = !isEmailChannelActivated" >
                                        <span class="toggle reviews"></span>
                                    </label>
                                </div>
                            </div>
                            <ul class="list_review mt-3" v-if="isEmailChannelActivated">
                                <li><a :class="progressClass('sender')" @click="openForm('sender')" href="javascript:void(0);">From</a></li>
                                <li><a :class="progressClass('subject')" @click="openForm('subject')" href="javascript:void(0);">Email Subject</a></li>
                                <li><a :class="progressClass('content')" @click="openForm('content')" class="" href="javascript:void(0);">Content</a></li>
                                <li><a :class="progressClass('tracking')" @click="openForm('tracking')" href="javascript:void(0);">Settings & Tracking</a></li>
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
                                        <input class="field" type="checkbox" :checked="isSMSChannelActivated" @change="isSMSChannelActivated = !isSMSChannelActivated">
                                        <span class="toggle reviews"></span>
                                    </label>
                                </div>
                            </div>
                            <ul class="list_review mt-3" v-if="isSMSChannelActivated">
                                <li><a :class="progressClass('smsSender')" @click="openForm('smsSender')" href="javascript:void(0);">From</a></li>
                                <li><a :class="progressClass('smsContent')" @click="openForm('smsContent')" href="javascript:void(0);">Content</a></li>
                                <li><a :class="progressClass('smsTracking')" @click="openForm('smsTracking')" href="javascript:void(0);">Settings & Tracking</a></li>
                            </ul>
                        </div>



                        <div class="reviw_howtouse" v-if="showHelp">
                            <a href="javascript:void(0);" class="close_x_icon2" @click="showHelp=false"><img src="assets/images/close_grey_line.svg"/></a>
                            <p class="fsize12 fw300 light_000">Learn how to use <br><strong>Campaigns</strong> in 60 seconds</p>
                            <img src="assets/images/review_play.svg"/>
                        </div>




                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--******************
                  PAGE LEFT SIDEBAR END
                 **********************-->
                <template v-if="configureCampaign">
                    <div class="table_head_action pb0 mb15">
                        <div class="row">
                            <div class="col">
                                <h3 class="htxt_medium_14 dark_600">Email channel</h3>
                            </div>
                            <div class="col text-right">
                                <p class="fsize14 dark_600 m-0">Active &nbsp; &nbsp;
                                    <label class="custom-form-switch mt-0">
                                        <input class="field" type="checkbox" :checked="isEmailChannelActivated" @change="isEmailChannelActivated = !isEmailChannelActivated">
                                        <span class="toggle green3"></span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="row" v-if="isEmailChannelActivated">
                        <div class="col-12">
                            <div class="card p35 br6 mb10" :class="{'disabled': disableSenderForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                        <span v-if="completedSenderForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">1</span>
                                    </div>
                                    <div :class="`${displaySenderForm == true ? 'col' : 'col-9'}`">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">From</h3>
                                        <ul class="review_camapaign_list" v-if="completedSenderForm==true && displaySenderForm==false">
                                            <li><span>From name</span><strong>{{senderForm.from_name}}</strong></li>
                                            <li><span>From email address</span><strong>{{senderForm.from_email}}</strong></li>
                                        </ul>
                                        <p class="htxt_regular_14 dark_400 m-0 ls4" v-else>Who is sending this email?</p>
                                    </div>
                                    <div class="col text-right" v-if="displaySenderForm==false">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" v-if="completedSenderForm" @click="openForm('sender')"> Edit</button>
                                        <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none" v-else @click="openForm('sender')">Add sender</button>

                                    </div>
                                    <div class="col text-right" v-if="displaySenderForm==true">
                                        <!--<button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Add sender</button>-->
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" @click="closeForm('sender')">Cancel</button>
                                        <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_green_400 ml20" @click="saveSenderInfo">Save</button>
                                    </div>
                                </div>

                                <div class="btop mt30 pt30" v-if="displaySenderForm==true">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-0">
                                                <label class="dark_600 fsize11 fw500 ls4">FROM NAME</label>
                                                <label class="dark_400 fsize11 fw500 ls4 float-right">A/B TEST &nbsp; <img src="assets/images/Review_c.svg"/></label>
                                                <input type="text" v-model="senderForm.from_name" required class="form-control h48" placeholder="Enter sender name" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-0">
                                                <label class="dark_600 fsize11 fw500 ls4">FROM EMAIL</label>
                                                <!--<input type="text" class="form-control h48" placeholder="Select sender email address" />-->
                                                <select v-model="senderForm.from_email" class="form-control h48 form-control-custom" required>
                                                    <option>Select sender email address</option>
                                                    <option :value="user.email">{{user.email}}</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>

                            <div class="card p35 br6 mb10" :class="{'disabled': disableSubjectForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                        <span v-if="completedSubjectForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">2</span>
                                    </div>
                                    <div :class="`${displaySubjectForm == true ? 'col' : 'col-9'}`">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">Subject</h3>
                                        <ul class="review_camapaign_list" v-if="completedSubjectForm ==true && displaySubjectForm==false">
                                            <li><span>Subject line</span><strong>{{subjectForm.subject}}</strong></li>
                                            <li><span>Email preview text</span><strong>{{subjectForm.preheader}}</strong></li>
                                        </ul>
                                        <p class="htxt_regular_14 dark_400 m-0 ls4" v-else>This text will be displayed in the Subject field in your recipient's email client</p>
                                    </div>
                                    <div class="col text-right" v-if="displaySubjectForm==false">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" v-if="completedSubjectForm" @click="openForm('subject')"> Edit</button>
                                        <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none" v-else @click="openForm('subject')">Add subject</button>
                                    </div>
                                    <div class="col text-right" v-if="displaySubjectForm==true">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" @click="closeForm('subject')">Cancel</button>
                                        <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_green_400 ml20" @click="saveSubjectInfo">Save</button>
                                    </div>
                                </div>
                                <div class="btop mt30 pt30" v-if="displaySubjectForm==true">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="dark_600 fsize11 fw500 ls4 text-uppercase">Subject line</label>
                                                <label class="dark_400 fsize11 fw500 ls4 float-right">A/B TEST &nbsp; <img src="assets/images/Review_c.svg"/></label>
                                                <!--<input type="text" class="form-control h48" placeholder="Enter your email subject line" />-->


                                                <div class="campaign_name_sec border br4 p10 pl20 pr20 fsize14 dark_200">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <input type="text" v-model="subjectForm.subject" class="textfield emoji2 fsize14 dark_200" id="fname" placeholder="Enter your email subject line" name="fname"></div>
                                                        <div class="col-4">
                                                            <div class="dropdown campaign_forms big">
                                                                <button class="btn dropdown-toggle bkg_light_000 w-100 p-1 text-left fw400 fsize14 shadow_none dark_200" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Insert personalisation
                                                                </button>
                                                                <div class="dropdown-menu w-100 dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-96px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <a class="dropdown-item" href="javascript:void(0);"><img src="assets/images/circle-dot.svg"> Option 1 </a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><img src="assets/images/circle-dot.svg"> Option 2 </a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><img src="assets/images/circle-dot.svg"> Option 3 </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-0">
                                                <label class="dark_600 fsize11 fw500 ls4 text-uppercase">Email preview text</label>
                                                <input type="text" v-model="subjectForm.preheader" class="form-control h48 emoji2" placeholder="Email preview text appears in an inbox after subject line" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="card p35 br6 mb10">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">3</span></div>
                                    <div class="col">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">Source</h3>
                                        <p class="htxt_regular_14 dark_400 m-0 ls4">Select review sources (review sites)</p>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Add Source</button>
                                    </div>
                                </div>
                            </div>-->
                            <div class="card p35 br6 mb10">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">3</span></div>
                                    <div class="col">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">Source</h3>
                                        <p class="htxt_regular_14 dark_400 m-0 ls4">Select review sources (review sites)</p>
                                    </div>
                                    <div class="col text-right">
                                        <!--<button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit Settings</button>-->
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Cancel</button>
                                        <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_green_400 ml20">Save</button>
                                    </div>
                                </div>

                                <div class="btop mt30 pt20">
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="nav nav-pills source_tab" role="tablist">
                                                <li class="mr15"><a class="active" data-toggle="pill" href="#MostPopular">Most Popular</a></li>
                                                <li class="mr15"><a class="" data-toggle="pill" href="#Automotive">Automotive</a></li>
                                                <li class="mr15"><a class="" data-toggle="pill" href="#Ecommerce">E-commerce</a></li>
                                                <li class="mr15"><a class="" data-toggle="pill" href="#Financial">Financial</a></li>
                                                <li class="mr15"><a class="" data-toggle="pill" href="#Healthcare">Healthcare</a></li>
                                                <li class="mr15"><a class="" data-toggle="pill" href="#HomeServices">Home Services</a></li>
                                                <li class="mr15"><a class="" data-toggle="pill" href="#Hotels">Hotels</a></li>

                                            </ul>
                                        </div>

                                        <div class="col-12">
                                            <div class="tab-content mt20">
                                                <!--======Tab 1 MostPopular====-->
                                                <div id="MostPopular" class="tab-pane active">
                                                    <div class="row" style="margin-right: -5px; margin-left: -5px;">
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pl5 pr5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row" style="margin-right: -5px; margin-left: -5px;">
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pl5 pr5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!--======Tab 2  Automotive=====-->
                                                <div id="Automotive" class="tab-pane fade">
                                                    <div class="row" style="margin-right: -5px; margin-left: -5px;">
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-2 source_box pr5 pl5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 source_box pl5 pr5">
                                                            <div class="br4 border p25 shadow5 source_box_inner">
                                                                <img class="mb10" src="assets/images/google_blue_40.svg"/>
                                                                <p class="fsize14 fw500 dark_600 m-0">Google</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--======Tab 3  Ecommerce=====-->
                                                <div id="Ecommerce" class="tab-pane fade">
                                                    tab 3
                                                </div>

                                                <!--======Tab 4  Financial=====-->
                                                <div id="Financial" class="tab-pane fade">
                                                    tab 4
                                                </div>

                                                <!--======Tab 5  Healthcare=====-->
                                                <div id="Healthcare" class="tab-pane fade">
                                                    tab 5
                                                </div>

                                                <!--======Tab 6  HomeServices=====-->
                                                <div id="HomeServices" class="tab-pane fade">
                                                    tab 6
                                                </div>

                                                <!--======Tab 7  Hotels=====-->
                                                <div id="Hotels" class="tab-pane fade">
                                                    tab 7
                                                </div>









                                            </div>
                                        </div>


                                    </div>



                                </div>
                            </div>

                            <div class="card p35 br6 mb10" :class="{'disabled': disableContentForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                        <span v-if="completedContentForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">3</span>
                                    </div>
                                    <div :class="`${displayContentForm == true ? 'col' : 'col-9'}`">

                                        <h3 class="htxt_medium_16 dark_700 mb-2">Content</h3>
                                        <ul class="review_camapaign_list" v-if="completedContentForm ==true && displayContentForm==false">
                                            <li><span><figure><img src="assets/images/Create_Ema_preview.png"></figure></span><strong><a href="javascript:void(0);" @click="loadEmailPreview">Preview Template “{{emailTemplate.template_name}}”</a> <br>
                                                <a href="javascript:void(0);" @click="loadEmailPreview">Preview plain text version</a><br>
                                                <a href="javascript:void(0);" @click="sendTestBox=true">Send test email</a>
                                                <div class="p20" v-if="sendTestBox">
                                                    Email Address: &nbsp;&nbsp;<input type="text" class="mr20" placeholder="Email Address" v-model="user.email" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" />
                                                    <button type="button" class="btn dark_btn h40 bkg_bl_gr" @click.prevent="sendTestEmail">Send</button>
                                                    <a href="javascript:void(0);" class="btn btn-link fsize14" @click="sendTestBox=false">Cancel</a>
                                                </div>
                                            </strong></li>
                                        </ul>
                                        <p class="htxt_regular_14 dark_400 m-0 ls4" v-else>Customize the content of your email.</p>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" v-if="completedContentForm" @click="loadEmailPreview"> Edit</button>
                                        <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none" v-else @click="openEmailTemplates">Edit content</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card p35 br6 mb10" :class="{'disabled': disableTrackingForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                        <span v-if="completedTrackingForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">4</span>
                                    </div>
                                    <div :class="`${displayTrackingForm == true ? 'col' : 'col-9'}`">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">Settings & Tracking</h3>
                                        <ul class="review_camapaign_list_check" v-if="completedTrackingForm ==true && displayTrackingForm==false">
                                            <li><strong><i class="ri-checkbox-circle-fill" :class="{'green_400': trackingForm.tracking_conversation}"></i> Use conversation to manage replies</strong><strong><i class="ri-checkbox-circle-fill" :class="{'green_400': trackingForm.tracking_google_analytics}"></i> Google Analytics</strong></li>
                                            <li><strong><i class="ri-checkbox-circle-fill" :class="{'green_400': trackingForm.tracking_open_read}"></i> Track opens / read</strong><strong><i class="ri-checkbox-circle-fill" :class="{'green_400': trackingForm.tracking_expire_link}"></i> Track clicks</strong></li>
                                        </ul>
                                        <p class="htxt_regular_14 dark_400 m-0 ls4" v-else>Customize your default campaign’s settings</p>
                                    </div>
                                    <div class="col text-right" v-if="displayTrackingForm==false">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" v-if="completedTrackingForm" @click="openForm('tracking')"> Edit</button>
                                        <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none" v-else @click="openForm('tracking')">Edit Settings</button>
                                    </div>
                                    <div class="col text-right" v-if="displayTrackingForm==true">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" @click="closeForm('tracking')">Cancel</button>
                                        <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_green_400 ml20" @click="saveTrackingInfo">Save</button>
                                    </div>
                                </div>
                                <div class="btop mt30 pt30" v-if="displayTrackingForm==true">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="htxt_regular_14 dark_600 mb10">
                                                <label class="custom-form-switch mt-0 float-left">
                                                    <input class="field" type="checkbox" value="1" v-model="trackingForm.tracking_conversation">
                                                    <span class="toggle reviews"></span>
                                                </label> &nbsp; Use conversation to manage replies</p>
                                            <p class="htxt_regular_12 dark_400 lh_19">When enabled, we’ll generate a special reply-to address for your campaign. We’ll filter “out of office” replies, then thread
                                                conversations into your subscribers’ profiles and display them in reports.</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="htxt_regular_14 dark_600 mb10">
                                                <label class="custom-form-switch mt-0 float-left">
                                                    <input class="field" type="checkbox" value="1" v-model="trackingForm.tracking_google_analytics">
                                                    <span class="toggle reviews"></span>
                                                </label> &nbsp;
                                                Google Analytics</p>
                                            <p class="htxt_regular_12 dark_400 lh_19">Track clicks from your campaigns all the way to purchases on your website. Requires Google Analytics on your website or Shopify Integration.</p>
                                        </div>
                                    </div>


                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <p class="htxt_regular_14 dark_600 mb10">
                                                <label class="custom-form-switch mt-0 float-left">
                                                    <input class="field" type="checkbox" value="1" v-model="trackingForm.tracking_open_read">
                                                    <span class="toggle reviews"></span>
                                                </label> &nbsp;
                                                Track opens / read</p>
                                            <p class="htxt_regular_12 dark_400 lh_19 m-0">Discover who opens your campaigns by tracking the number of times an invisible web beacon embedded in the campaign is downloaded. </p>
                                        </div>
                                        <div class="col-6">
                                            <p class="htxt_regular_14 dark_600 mb10">
                                                <label class="custom-form-switch mt-0 float-left">
                                                    <input class="field" type="checkbox" value="1" v-model="trackingForm.tracking_expire_link">
                                                    <span class="toggle reviews"></span>
                                                </label> &nbsp;
                                                Automaticaly expire link</p>
                                            <p class="htxt_regular_12 dark_400 lh_19 m-0">Discover which campaign links were clicked, how many times they were clicked, and who did the clicking.</p>
                                        </div>
                                    </div>



                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="row" v-else>
                        <div class="col-12">
                            <div class="card p50 br6 mb-0 text-center">
                                <span class="circle-icon-36 d-block m-auto bkg_green_000"><i class="ri-message-3-fill email_300 fsize17"></i></span>
                                <h3 class="htxt_medium_16 dark_700 mt10 mb10">Email review requests</h3>
                                <p class="htxt_regular_14 dark_400 m-0 ls4">Activate channel to send Email review requests</p>
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
                                        <input class="field" type="checkbox" :checked="isSMSChannelActivated" @change="isSMSChannelActivated = !isSMSChannelActivated" >
                                        <span class="toggle green3"></span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row" v-if="isSMSChannelActivated">
                        <div class="col-12">
                            <div class="card p35 br6 mb10" :class="{'disabled': disableSMSSenderForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                        <span v-if="completedSMSSenderForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">1</span>
                                    </div>
                                    <div :class="`${displaySMSSenderForm == true ? 'col' : 'col-9'}`">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">From</h3>
                                        <ul class="review_camapaign_list" v-if="completedSMSSenderForm==true && displaySMSSenderForm==false">
                                            <li><span>From name</span><strong>{{senderSMSForm.from_name}}</strong></li>
                                            <li><span>From sms number</span><strong>{{mobileNoFormat(senderSMSForm.sms_sender)}}</strong></li>
                                        </ul>
                                        <p class="htxt_regular_14 dark_400 m-0 ls4" v-else>Who is sending this sms?</p>
                                    </div>
                                    <div class="col text-right" v-if="displaySMSSenderForm==false">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" v-if="completedSMSSenderForm" @click="openForm('smsSender')"> Edit</button>
                                        <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none" v-else @click="openForm('smsSender')">Add sender</button>

                                    </div>
                                    <div class="col text-right" v-if="displaySMSSenderForm==true">
                                        <!--<button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Add sender</button>-->
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" @click="closeForm('smsSender')">Cancel</button>
                                        <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_green_400 ml20" @click="saveSMSSenderInfo">Save</button>
                                    </div>
                                </div>

                                <div class="btop mt30 pt30" v-if="displaySMSSenderForm==true">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-0">
                                                <label class="dark_600 fsize11 fw500 ls4">FROM NAME</label>
                                                <label class="dark_400 fsize11 fw500 ls4 float-right">A/B TEST &nbsp; <img src="assets/images/Review_c.svg"/></label>
                                                <input type="text" v-model="senderSMSForm.from_name" required class="form-control h48" placeholder="Enter sender name" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-0">
                                                <label class="dark_600 fsize11 fw500 ls4">FROM PHONE NUMBER</label>
                                                <!--<input type="text" class="form-control h48" placeholder="Select sender email address" />-->
                                                <select v-model="senderSMSForm.sms_sender" class="form-control h48 form-control-custom" required>
                                                    <option>Select sender from number</option>
                                                    <option :value="user.twilioNumber">{{mobileNoFormat(user.twilioNumber)}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card p35 br6 mb10" :class="{'disabled': disableSMSContentForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                        <span v-if="completedSMSContentForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">2</span>
                                    </div>
                                    <div :class="`${displaySMSContentForm == true ? 'col' : 'col-9'}`">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">Content</h3>
                                        <ul class="review_camapaign_list" v-if="completedSMSTrackingForm ==true && displaySMSContentForm==false">
                                            <li>
                                            <span class="smsbox">
                                                <div class="row mb-1">
                                                    <div class="col"><p class="m-0 fsize8 light_700"><img width="10" src="assets/images/message_icon_green.svg"> &nbsp; MESSAGES</p></div>
                                                    <div class="col text-right"><p class="m-0 fsize8 light_700">now</p></div>
                                                </div>
                                                <p class="fsize9 fw500 dark_900 mb-1">{{smsData.greeting}}</p>
                                                <p class="fsize9 fw300 dark_900 m-0" v-html="setStringLimit(smsData.introduction + ' '+ getDecodeContent(smsData.stripo_compiled_html), 150)">Hello Julia, It was a pleasure doing business with you. Thank you for giving us a try. You can click this link to leave your review...</p>
                                            </span>
                                                <strong>{{setStringLimit(smsData.greeting+' '+smsData.introduction, 55)}} <br>
                                                    <a href="javascript:void(0);" @click="loadSMSPreview">Preview SMS Template “{{smsTemplate.template_name}}”</a><br>
                                                    <a href="javascript:void(0);" @click="sendTestSMSBox=true">Send test SMS</a>
                                                    <div class="p20" v-if="sendTestSMSBox">
                                                        Phone Number: &nbsp;&nbsp;<input type="text" class="mr20" placeholder="Phone Number" v-model="user.phone" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" />
                                                        <button type="button" class="btn dark_btn h40 bkg_bl_gr" @click.prevent="sendTestSMS">Send</button>
                                                        <a href="javascript:void(0);" class="btn btn-link fsize14" @click="sendTestSMSBox=false">Cancel</a>
                                                    </div>
                                                </strong>
                                            </li>
                                        </ul>
                                        <p class="htxt_regular_14 dark_400 m-0 ls4" v-else>Customize the content of your sms.</p>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" v-if="completedSMSContentForm" @click="loadSMSPreview"> Edit</button>
                                        <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none" v-else @click="openSMSTemplates">Edit content</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card p35 br6 mb10" :class="{'disabled': disableSMSTrackingForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                        <span v-if="completedSMSTrackingForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">4</span>
                                    </div>
                                    <div :class="`${displaySMSTrackingForm == true ? 'col' : 'col-9'}`">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">Settings & Tracking</h3>
                                        <ul class="review_camapaign_list_check" v-if="completedSMSTrackingForm ==true && displaySMSTrackingForm==false">
                                            <li><strong><i class="ri-checkbox-circle-fill" :class="{'green_400': trackingForm.tracking_conversation}"></i> Use conversation to manage replies</strong><strong><i class="ri-checkbox-circle-fill" :class="{'green_400': trackingForm.tracking_google_analytics}"></i> Google Analytics</strong></li>
                                            <li><strong><i class="ri-checkbox-circle-fill" :class="{'green_400': trackingForm.tracking_open_read}"></i> Track opens / read</strong><strong><i class="ri-checkbox-circle-fill" :class="{'green_400': trackingForm.tracking_expire_link}"></i> Track clicks</strong></li>
                                        </ul>
                                        <p class="htxt_regular_14 dark_400 m-0 ls4" v-else>Customize your default campaign’s settings</p>
                                    </div>
                                    <div class="col text-right" v-if="displaySMSTrackingForm==false">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" v-if="completedSMSTrackingForm" @click="openForm('smsTracking')"> Edit</button>
                                        <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none" v-else @click="openForm('smsTracking')">Edit Settings</button>
                                    </div>
                                    <div class="col text-right" v-if="displaySMSTrackingForm==true">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" @click="closeForm('smsTracking')">Cancel</button>
                                        <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_green_400 ml20" @click="saveSMSTrackingInfo">Save</button>
                                    </div>
                                </div>
                                <div class="btop mt30 pt30" v-if="displaySMSTrackingForm==true">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="htxt_regular_14 dark_600 mb10">
                                                <label class="custom-form-switch mt-0 float-left">
                                                    <input class="field" type="checkbox" value="1" v-model="trackingForm.tracking_conversation">
                                                    <span class="toggle reviews"></span>
                                                </label> &nbsp; Use conversation to manage replies</p>
                                            <p class="htxt_regular_12 dark_400 lh_19">When enabled, we’ll generate a special reply-to address for your campaign. We’ll filter “out of office” replies, then thread
                                                conversations into your subscribers’ profiles and display them in reports.</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="htxt_regular_14 dark_600 mb10">
                                                <label class="custom-form-switch mt-0 float-left">
                                                    <input class="field" type="checkbox" value="1" v-model="trackingForm.tracking_google_analytics">
                                                    <span class="toggle reviews"></span>
                                                </label> &nbsp;
                                                Google Analytics</p>
                                            <p class="htxt_regular_12 dark_400 lh_19">Track clicks from your campaigns all the way to purchases on your website. Requires Google Analytics on your website or Shopify Integration.</p>
                                        </div>
                                    </div>


                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <p class="htxt_regular_14 dark_600 mb10">
                                                <label class="custom-form-switch mt-0 float-left">
                                                    <input class="field" type="checkbox" value="1" v-model="trackingForm.tracking_open_read">
                                                    <span class="toggle reviews"></span>
                                                </label> &nbsp;
                                                Track opens / read</p>
                                            <p class="htxt_regular_12 dark_400 lh_19 m-0">Discover who opens your campaigns by tracking the number of times an invisible web beacon embedded in the campaign is downloaded. </p>
                                        </div>
                                        <div class="col-6">
                                            <p class="htxt_regular_14 dark_600 mb10">
                                                <label class="custom-form-switch mt-0 float-left">
                                                    <input class="field" type="checkbox" value="1" v-model="trackingForm.tracking_expire_link">
                                                    <span class="toggle reviews"></span>
                                                </label> &nbsp;
                                                Automaticaly expire link</p>
                                            <p class="htxt_regular_12 dark_400 lh_19 m-0">Discover which campaign links were clicked, how many times they were clicked, and who did the clicking.</p>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row" v-else>
                        <div class="col-12">
                            <div class="card p50 br6 mb-0 text-center">
                                <span class="circle-icon-36 d-block m-auto bkg_green_000"><i class="ri-message-3-fill sms_300 fsize17"></i></span>
                                <h3 class="htxt_medium_16 dark_700 mt10 mb10">SMS review requests</h3>
                                <p class="htxt_regular_14 dark_400 m-0 ls4">Activate channel to send SMS review requests</p>
                            </div>
                        </div>
                    </div>
                </template>
                <email-templates
                    v-if="showEmailTemplates"
                    :templates="emailTemplates"
                    :user="user"
                    @hideEmailTemplate="closeEmailTemplates"
                    @updateEmailCampaignId="setEmailCampaignId"
                ></email-templates>
                <sms-templates
                    v-if="showSMSTemplates"
                    :templates="smsTemplates"
                    :user="user"
                    @hideSMSTemplate="closeSMSTemplates"
                    @updateSMSCampaignId="setSMSCampaignId"
                ></sms-templates>

            </div>

        </div>

        <div class="modal fade show" id="EditOverviewPreview">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 1200px;">
                <div class="modal-content review" style="width: 1200px;">
                    <div class="modal-body p0 mt0 br5" style="width: 1200px;">
                        <!--<system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="4"></system-messages>-->
                        <loading :isLoading="loading"></loading>
                        <div class="row">
                            <div class="col-md-4 pr0">
                                <div class="email_editor_left">
                                    <div class="p10 bbot"><p class="m0 txt_dark fw500">Email Configuration</p></div>
                                    <div class="p20">
                                        <div class="form-group">
                                            <label class="">Greetings</label>
                                            <input v-model="greetings" class="form-control h52" required="" placeholder="Hi, We’d love your feeed..." type="text">
                                        </div>

                                        <div class="form-group mb0">
                                            <label class="">Content</label>
                                            <a class="fsize14 open_editor" href="#"><i class=""><img src="/assets/images/open_editor.png"/> </i> &nbsp; Open editor</a>
                                            <textarea v-model="introduction" style="min-height: 238px; resize: none;" class="form-control p20 fsize12" v-html="introduction">I have hinted that I would often jerk poor Queequeg from between the whale and the ship—where he would occasionally fall, from the incessant rolling and swaying of both.

										But this was not the only jamming jeopardy he was exposed to. Unappalled by the massacre made upon them...</textarea>
                                        </div>
                                    </div>
                                    <div class="p20 pt0" v-if="sendTestBox==false">
                                        <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" @click="saveEditChanges">Save</button>
                                        <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" @click="openEmailTemplates">Change Template</button>
                                        <a class="dark_200 fsize12 fw500 ml20 text-uppercase" href="javascript:void(0);" @click="sendTestBox=true">Send test email</a>
                                    </div>
                                    <div class="p20 pt0" id="wfTestCtr" v-if="sendTestBox">
                                        <input type="text" class="mr20" placeholder="Email Address" v-model="user.email" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" />
                                        <button type="button" class="btn dark_btn h40 bkg_bl_gr" @click.prevent="sendTestEmail">Send</button>
                                        <a href="javascript:void(0);" class="btn btn-link fsize14" @click="sendTestBox=false">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 pl3">
                                <div class="email_editor_right preview" style="max-height:800px;overflow:auto;border-left:5px solid;">
                                    <div class="p10 bbot position-relative"><p class="m0 txt_dark fw500">Preview</p>
                                    </div>
                                    <div class="p30" id="wf_preview_edit_template_content">
                                        <div class="email_preview_sec br5 pb20" style="min-height: 500px;" v-html="content">
                                            Content goes here
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade show" id="EditSMSPreview">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 1200px;">
                <div class="modal-content review" style="width: 1200px;">
                    <div class="modal-body p0 mt0 br5" style="width: 1200px;">
                        <!--<system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="5"></system-messages>-->
                        <loading :isLoading="loading"></loading>
                        <div class="row">
                            <div class="col-md-4 pr0">
                                <div class="email_editor_left">
                                    <div class="p10 bbot"><p class="m0 txt_dark fw500">SMS Configuration</p></div>
                                    <div class="p20">
                                        <div class="form-group">
                                            <label class="">Greetings</label>
                                            <input v-model="smsGreetings" class="form-control h52" required="" placeholder="Hi, We’d love your feeed..." type="text">
                                        </div>

                                        <div class="form-group mb0">
                                            <label class="">Content</label>
                                            <a class="fsize14 open_editor" href="#"><i class=""><img src="/assets/images/open_editor.png"/> </i> &nbsp; Open editor</a>
                                            <textarea v-model="smsIntroduction" style="min-height: 238px; resize: none;" class="form-control p20 fsize12" v-html="smsIntroduction">I have hinted that I would often jerk poor Queequeg from between the whale and the ship—where he would occasionally fall, from the incessant rolling and swaying of both.

										But this was not the only jamming jeopardy he was exposed to. Unappalled by the massacre made upon them...</textarea>
                                        </div>
                                    </div>
                                    <div class="p20 pt0" v-if="sendTestBox==false">
                                        <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" @click="saveSMSEditChanges">Save</button>
                                        <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" @click="openSMSTemplates">Change Template</button>
                                        <a class="dark_200 fsize12 fw500 ml20 text-uppercase" href="javascript:void(0);" @click="sendTestBox=true">Send test email</a>
                                    </div>
                                    <div class="p20 pt0" id="wfTestCtr" v-if="sendTestBox">
                                        <input type="text" class="mr20" placeholder="Phone Number" v-model="user.mobile" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" />
                                        <button type="button" class="btn dark_btn h40 bkg_bl_gr" @click.prevent="sendTestSMS">Send</button>
                                        <a href="javascript:void(0);" class="btn btn-link fsize14" @click="sendTestBox=false">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 pl3">
                                <div class="email_editor_right preview" style="max-height:800px;overflow:auto;border-left:5px solid;">
                                    <div class="p10 bbot position-relative"><p class="m0 txt_dark fw500">Preview</p>
                                    </div>
                                    <div class="sms_preview">
                                        <div class="phone_sms">
                                            <div class="inner">
                                                <p v-html="smsContent"></p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <p><small>{{ timestampToDateFormat(Math.floor(Date.now() / 1000)) }}</small></p>
                                        </div>
                                    </div>
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
    import EmailTemplates from "@/components/admin/brandboost/onsite/setup/EmailTemplates";
    import SmsTemplates from "@/components/admin/brandboost/onsite/setup/SmsTemplates";
    import jq from "jquery";
    export default {
        components: {
            EmailTemplates,
            SmsTemplates,
            apexchart: VueApexCharts,
        },
        data() {
            return {
                refreshMessage: 1,


                loading: true,
                showHelp: true,
                configureCampaign: true,
                showEmailTemplates: false,
                showSMSTemplates: false,
                emailTemplates: '',
                smsTemplates: '',
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                offSiteData: '',
                setTab: '',
                fromNumber: '',
                displayCustomLinkExpiry: false,
                displaySenderForm: false,
                displaySubjectForm: false,
                displayContentForm: false,
                displayTrackingForm: false,
                displaySMSSenderForm: false,
                displaySMSContentForm: false,
                displaySMSTrackingForm: false,
                completedSenderForm: false,
                completedSubjectForm: false,
                completedContentForm: false,
                completedTrackingForm: false,
                completedSMSSenderForm: false,
                completedSMSContentForm: false,
                completedSMSTrackingForm: false,
                disableSenderForm: false,
                disableSubjectForm: false,
                disableContentForm: false,
                disableTrackingForm: false,
                disableSMSSenderForm: false,
                disableSMSContentForm: false,
                disableSMSTrackingForm: false,
                isEmailChannelActivated: true,
                isSMSChannelActivated:false,
                senderForm: {
                    _token: this.csrf_token(),
                    requestType: 'feedback',
                    brandboostId: this.$route.params.id,
                    from_name: '',
                    from_email: ''
                },
                subjectForm: {
                    _token: this.csrf_token(),
                    requestType: 'subject',
                    brandboostId: this.$route.params.id,
                    subject: '',
                    preheader: ''
                },
                trackingForm: {
                    _token: this.csrf_token(),
                    requestType: 'tracking',
                    brandboostId: this.$route.params.id,
                    tracking_conversation: '',
                    tracking_google_analytics: '',
                    tracking_open_read: '',
                    tracking_expire_link : '',
                },
                senderSMSForm: {
                    _token: this.csrf_token(),
                    requestType: 'feedback',
                    brandboostId: this.$route.params.id,
                    from_name: '',
                    sms_sender: ''
                },
                subjectForm: {
                    _token: this.csrf_token(),
                    requestType: 'subject',
                    brandboostId: this.$route.params.id,
                    subject: '',
                    preheader: ''
                },
                trackingForm: {
                    _token: this.csrf_token(),
                    requestType: 'tracking',
                    brandboostId: this.$route.params.id,
                    tracking_conversation: '',
                    tracking_google_analytics: '',
                    tracking_open_read: '',
                    tracking_expire_link : '',
                },
                channelForm: {
                    _token: this.csrf_token(),
                    requestType: 'channelStatus',
                    brandboostId: this.$route.params.id,
                    email_channel: '',
                    sms_channel: ''
                },
                endCampaign: '',
                emailCampaignId: '',
                smsCampaignId: '',
                greetings: '',
                introduction: '',
                content: '',
                smsGreetings: '',
                smsIntroduction: '',
                smsContent: '',
                progressRate: 0,
                sendTestBox: false,
                sendTestSMSBox: false,
                emailTemplate: '',
                smsTemplate: '',
                emailData: '',
                smsData: '',
                series: [0],
                chartOptions: {
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                size: '80%',
                            }
                        },
                    },
                    colors: ['#6672E8'],
                    labels: ['Completed'],

                }
            }
        },
        created() {
            this.loadCampaignSettings();
        },
        mounted() {
            //loadJQScript(35);
        },
        watch: {
            completedSenderForm: function(){
                this.validateStepCompletion();
            },
            completedSubjectForm: function(){
                this.validateStepCompletion();
            },
            completedContentForm: function(){
                this.validateStepCompletion();
            },
            completedTrackingForm: function(){
                this.validateStepCompletion();
            },
            isEmailChannelActivated: function(){
                this.channelForm.email_channel = this.isEmailChannelActivated;
                this.saveChannelStatus();
                this.validateStepCompletion();
            },
            isSMSChannelActivated: function(){
                this.channelForm.sms_channel = this.isSMSChannelActivated;
                this.saveChannelStatus();
                this.validateStepCompletion();
            },
            greetings: function(){
                jq("#wf_edit_template_greeting_EDITOR").text(this.greetings);
                jq("#wf_edit_sms_template_greeting_Preview").text(this.greetings);
            },
            introduction: function(){
                jq("#wf_edit_template_introduction_EDITOR").text(this.introduction);
                jq("#wf_edit_sms_template_introduction_Preview").text(this.introduction);
            },
            smsGreetings: function(){
                jq("#wf_edit_sms_template_greeting_Preview").text(this.smsGreetings);
            },
            smsIntroduction: function(){
                jq("#wf_edit_sms_template_introduction_Preview").text(this.smsIntroduction);
            },

        },
        computed: {
            isDisabled: function(){
                return 'disabled'
            },
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
            openEmailTemplates: function(){
                this.showEmailTemplates = true;
                this.showSMSTemplates = false;
                this.configureCampaign = false;
                document.querySelector('#hideOverviewPreviewForm').click();
            },
            closeEmailTemplates: function(){
                this.showEmailTemplates = false;
                this.showSMSTemplates = false;
                this.configureCampaign = true;
            },
            disableAllCards: function(form){
                this.disableSenderForm = true;
                this.disableSubjectForm = true;
                this.disableContentForm = true;
                this.disableTrackingForm = true;
                if(form == 'sender'){
                    this.disableSenderForm = false;
                }else if(form == 'subject'){
                    this.disableSubjectForm = false;
                }else if(form == 'content'){
                    this.disableContentForm = false;
                }else if(form == 'tracking'){
                    this.disableTrackingForm = false;
                }

            },
            enableAllCards: function(form){
                this.disableSenderForm = false;
                this.disableSubjectForm = false;
                this.disableContentForm = false;
                this.disableTrackingForm = false;

                this.disableSMSSenderForm = false;
                this.disableSMSContentForm = false;
                this.disableSMSTrackingForm = false;
            },
            loadCampaignSettings: function(){
                axios.get('/admin/brandboost/onsite_setup/' + this.campaignId)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaign = response.data.brandboostData;
                        this.feedbackResponse = response.data.feedbackResponse;
                        this.offSiteData = response.data.offSiteData;
                        this.setTab = response.data.setTab;
                        //this.fromNumber = this.mobileNoFormat(response.data.fromNumber);
                        this.fromNumber = this.mobileNoFormat(this.feedbackResponse.sms_sender);
                        this.user = response.data.aUserInfo;
                        this.emailTemplates = response.data.oEmailTemplates;
                        this.smsTemplates = response.data.oSMSTemplates;
                        this.loading = false;
                        //Set SenderForm fields
                        this.senderForm.from_name = this.feedbackResponse.from_name;
                        this.senderForm.from_email = this.feedbackResponse.from_email;
                        this.senderForm.brandboostId = this.campaignId;

                        this.senderSMSForm.from_name = this.feedbackResponse.from_name;
                        this.senderSMSForm.sms_sender = this.feedbackResponse.sms_sender;
                        this.senderSMSForm.brandboostId = this.campaignId;
                        //Set SubjectForm fields
                        this.subjectForm.subject = this.campaign.subject;
                        this.subjectForm.preheader = this.campaign.preheader;
                        //Set Tracking fields
                        this.trackingForm.tracking_conversation = this.campaign.tracking_conversation;
                        this.trackingForm.tracking_google_analytics = this.campaign.tracking_google_analytics;
                        this.trackingForm.tracking_open_read = this.campaign.tracking_open_read;
                        this.trackingForm.tracking_expire_link = this.campaign.tracking_expire_link;
                        //Set Channel Status
                        this.isEmailChannelActivated = this.campaign.email_channel;
                        this.isSMSChannelActivated = this.campaign.sms_channel;
                        this.endCampaign = response.data.endCampaign;
                        this.assignCampaignIds(this.endCampaign);
                        this.emailTemplate = response.data.emailTemplate;
                        this.smsTemplate = response.data.smsTemplate;
                        this.emailData = response.data.emailData;
                        this.smsData = response.data.smsData;
                        //Validate Step Completion
                        this.validateStepCompletion();
                    });
            },
            assignCampaignIds: function(data){
                data.forEach(campaign => {
                    if(campaign.campaign_type.toLowerCase() == 'email'){
                        this.emailCampaignId = campaign.id;
                        this.completedContentForm = true;
                        this.validateStepCompletion();
                    }else if(campaign.campaign_type.toLowerCase() == 'sms'){
                        this.smsCampaignId = campaign.id;
                        this.completedSMSContentForm = true;
                        this.validateStepCompletion();
                    }
                });
            },
            validateStepCompletion: function(){
                //Sender form
                this.completedSenderForm = false;
                this.completedSubjectForm = false;
                this.completedTrackingForm = false;

                this.completedSMSSenderForm = false;
                this.completedSMSTrackingForm = false;
                let completedPercentage = 0;
                let offset = 0;
                if(this.isEmailChannelActivated && this.isSMSChannelActivated){
                    offset = 14.28;
                }else if(this.isEmailChannelActivated && this.isSMSChannelActivated == false){
                    offset = 25;
                }else if(this.isEmailChannelActivated == false && this.isSMSChannelActivated == true){
                    offset = 33.33;
                }else{
                    offset = 0;
                }

                if(this.isEmailChannelActivated == true){
                    if(this.senderForm.from_name && this.senderForm.from_email){
                        this.completedSenderForm = true;
                        completedPercentage = completedPercentage + offset;
                    }
                    if(this.subjectForm.subject && this.subjectForm.preheader){
                        this.completedSubjectForm = true;
                        completedPercentage = completedPercentage + offset;
                    }
                    if(this.emailCampaignId>0){
                        this.completedContentForm = true;
                        completedPercentage = completedPercentage + offset;
                    }
                    if(this.trackingForm.tracking_conversation || this.trackingForm.tracking_google_analytics || this.trackingForm.tracking_open_read || this.trackingForm.tracking_expire_link){
                        this.completedTrackingForm = true;
                        completedPercentage = completedPercentage + offset;
                    }
                }

                if(this.isSMSChannelActivated == true){
                    if(this.senderSMSForm.from_name && this.senderSMSForm.sms_sender){
                        this.completedSMSSenderForm = true;
                        completedPercentage = completedPercentage + offset;
                    }
                    if(this.smsCampaignId>0){
                        this.completedSMSContentForm = true;
                        completedPercentage = completedPercentage + offset;
                    }

                    if(this.trackingForm.tracking_conversation || this.trackingForm.tracking_google_analytics || this.trackingForm.tracking_open_read || this.trackingForm.tracking_expire_link){
                        this.completedSMSTrackingForm = true;
                        completedPercentage = completedPercentage + offset;
                    }
                }
                this.progressRate = Math.ceil(completedPercentage);
                this.series = [this.progressRate];

            },
            progressClass: function(form){
                let className;
                let activeClassName;
                if(form == 'sender'){
                    className = this.displaySenderForm == true ? 'active' : '';
                    activeClassName = this.completedSenderForm ? 'done' : '';
                }else if(form == 'subject'){
                    className = this.displaySubjectForm == true ? 'active' : '';
                    activeClassName = this.completedSubjectForm ? 'done' : '';
                }else if(form == 'content'){
                    className = this.displayContentForm == true ? 'active' : '';
                    activeClassName = this.completedContentForm ? 'done' : '';
                }else if(form == 'tracking'){
                    className = this.displayTrackingForm == true ? 'active' : '';
                    activeClassName = this.completedTrackingForm ? 'done' : '';
                }else if(form == 'smsSender'){
                    className = this.displaySMSSenderForm == true ? 'active' : '';
                    activeClassName = this.completedSMSSenderForm ? 'done' : '';
                }else if(form == 'smsContent'){
                    className = this.displaySMSContentForm == true ? 'active' : '';
                    activeClassName = this.completedSMSContentForm ? 'done' : '';
                }else if(form == 'smsTracking'){
                    className = this.displaySMSTrackingForm == true ? 'active' : '';
                    activeClassName = this.completedSMSTrackingForm ? 'done' : '';
                }
                return className+ ' '+activeClassName;
            },
            openForm: function(form){
                this.resetAllForms();
                this.disableAllCards(form);
                if(form == 'sender'){
                    this.displaySenderForm = true;
                }else if(form == 'subject'){
                    this.displaySubjectForm = true;
                }else if(form == 'content'){
                    this.displayContentForm = true;
                    this.openEmailTemplates();
                }else if(form == 'tracking'){
                    this.displayTrackingForm = true;
                }else if(form == 'smsSender'){
                    this.displaySMSSenderForm = true;
                }else if(form == 'smsContent'){
                    this.displaySMSContentForm = true;
                    this.openSMSTemplates();
                }else if(form == 'smsTracking'){
                    this.displaySMSTrackingForm = true;
                }
            },
            closeForm: function(form){
                this.resetAllForms();
                this.enableAllCards(form);
            },
            resetAllForms: function(){
                this.displaySenderForm = false;
                this.displaySubjectForm = false;
                this.displayContentForm = false;
                this.displayTrackingForm = false;

                this.displaySMSSenderForm = false;
                this.displaySMSContentForm = false;
                this.displaySMSTrackingForm = false;
            },
            saveSenderInfo: function(){
                this.loading = true;
                axios.post('/admin/brandboost/saveOnsiteConfiguration', this.senderForm)
                    .then(response => {
                        if(response.data.status =='success'){

                            this.displayMessage('success', 'Updated the changes successfully!!');
                            this.loading = false;
                            this.closeForm('sender');
                            this.validateStepCompletion();
                        }
                    });

            },
            saveSMSSenderInfo: function(){
                this.loading = true;
                axios.post('/admin/brandboost/saveOnsiteConfiguration', this.senderSMSForm)
                    .then(response => {
                        if(response.data.status =='success'){

                            this.displayMessage('success', 'Updated the changes successfully!!');
                            this.loading = false;
                            this.closeForm('smsSender');
                            this.validateStepCompletion();
                        }
                    });

            },
            saveSubjectInfo: function(){
                this.loading = true;
                axios.post('/admin/brandboost/saveOnsiteConfiguration', this.subjectForm)
                    .then(response => {
                        if(response.data.status =='success'){

                            this.displayMessage('success', 'Updated the changes successfully!!');
                            this.loading = false;
                            this.closeForm('subject');
                            this.validateStepCompletion();
                        }
                    });
            },
            saveTrackingInfo: function(){
                this.loading = true;
                axios.post('/admin/brandboost/saveOnsiteConfiguration', this.trackingForm)
                    .then(response => {
                        if(response.data.status =='success'){

                            this.displayMessage('success', 'Updated the changes successfully!!');
                            this.loading = false;
                            this.closeForm('tracking');
                            this.validateStepCompletion();
                        }
                    });
            },
            saveSMSTrackingInfo: function(){
                this.loading = true;
                axios.post('/admin/brandboost/saveOnsiteConfiguration', this.trackingForm)
                    .then(response => {
                        if(response.data.status =='success'){

                            this.displayMessage('success', 'Updated the changes successfully!!');
                            this.loading = false;
                            this.closeForm('smsTracking');
                            this.validateStepCompletion();
                        }
                    });
            },
            saveChannelStatus: function(){
                this.loading = true;
                axios.post('/admin/brandboost/saveOnsiteConfiguration', this.channelForm)
                    .then(response => {
                        if(response.data.status =='success'){

                            this.loading = false;
                        }
                    });
            },
            saveCampaign: function(){
                this.loading = true;
                axios.post('/admin/brandboost/changeStatus', {brandboost_id:this.$route.params.id, status: '1', _token: this.csrf_token()})
                    .then(response => {
                        if(response.data.status =='success'){

                            this.displayMessage('success', 'Campaign saved successfully!');
                            this.loading = false;
                            window.location.href = '/admin#/reviews/campaign/'+this.$route.params.id;
                        }
                    });
            },
            loadEmailPreview: function(){
                this.loading = true;
                axios.post('/admin/workflow/previewWorkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: 'brandboost',
                    campaignId: this.emailCampaignId,
                    moduleUnitId: this.$route.params.id,
                })
                    .then(response => {
                        this.loading = false;
                        this.content = response.data.content;
                        this.introduction = response.data.introduction;
                        this.greetings = response.data.greeting;
                    });
                document.querySelector('#displayOverviewPreviewForm').click();
            },
            loadSMSPreview: function(){
                this.loading = true;
                axios.post('/admin/workflow/previewWorkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: 'brandboost',
                    campaignId: this.smsCampaignId,
                    moduleUnitId: this.$route.params.id,
                })
                    .then(response => {
                        this.loading = false;
                        this.smsContent = response.data.content.replace(/\r\n|\r|\n/g, "<br />").replace('wf_edit_sms_template_greeting', 'wf_edit_sms_template_greeting_Preview').replace('wf_edit_sms_template_introduction_EDITOR', 'wf_edit_sms_template_introduction_Preview');
                        this.smsIntroduction = response.data.introduction;
                        this.smsGreetings = response.data.greeting;
                    });
                document.querySelector('#displaySMSPreviewForm').click();
            },
            saveEditChanges: function(){
                this.loading = true;
                axios.post('/admin/workflow/updateWorkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: 'brandboost',
                    greeting: this.greetings,
                    introduction: this.introduction,
                    campaignId: this.emailCampaignId,
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.loading = false;

                            this.displayMessage('success', 'Saved changes successfully!');
                        }
                    });
            },
            saveSMSEditChanges: function(){
                this.loading = true;
                axios.post('/admin/workflow/updateWorkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: 'brandboost',
                    greeting: this.smsGreetings,
                    introduction: this.smsIntroduction,
                    campaignId: this.smsCampaignId,
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.loading = false;

                            this.displayMessage('success', 'Saved changes successfully!');
                            this.setSMSCampaignId(this.smsCampaignId, this.smsTemplate.template_name, response.data.campaignInfo);
                        }
                    });
            },
            sendTestEmail: function(){
                this.loading = true;
                axios.post('/admin/workflow/sendTestEmailworkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: 'brandboost',
                    moduleUnitID: this.$route.params.id,
                    campaignId: this.emailCampaignId,
                    email: this.user.email
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.loading = false;

                            this.displayMessage('success', 'Test email sent successfully!');
                        }
                    });
            },
            sendTestSMS: function(){
                this.loading = true;
                axios.post('/admin/workflow/sendTestSMSworkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: 'brandboost',
                    moduleUnitID: this.$route.params.id,
                    campaignId: this.smsCampaignId,
                    number: this.user.phone
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.loading = false;

                            this.displayMessage('success', 'Test email sent successfully!');
                        }
                    });
            },
            openSMSTemplates: function(){
                this.showSMSTemplates = true;
                this.showEmailTemplates = false;
                this.configureCampaign = false;
                document.querySelector('#hideSMSPreviewForm').click();
            },
            closeSMSTemplates: function(){
                this.showSMSTemplates = false;
                this.showEmailTemplates = false;
                this.configureCampaign = true;
            },
            setEmailCampaignId: function(id, templateName){
                this.emailCampaignId = id;
                this.emailTemplate.template_name = templateName;
                this.validateStepCompletion();
            },
            setSMSCampaignId: function(id, templateName, oCampaign){
                this.smsCampaignId = id;
                this.smsTemplate.template_name = templateName;
                this.smsData = oCampaign;
                this.validateStepCompletion();
            },
            getDecodeContent: function(content){
                return atob(content);
            },
        }
    };
    $(document).ready(function(){
        $(document).on("click", "#displayOverviewPreviewForm", function(){
            $("#EditOverviewPreview").modal('show');
        })
        $(document).on("click", "#hideOverviewPreviewForm", function(){
            $("#EditOverviewPreview").modal('hide');
        })
        $(document).on("click", "#displaySMSPreviewForm", function(){
            $("#EditSMSPreview").modal('show');
        })
        $(document).on("click", "#hideSMSPreviewForm", function(){
            $("#EditSMSPreview").modal('hide');
        })

    });
</script>
<style>
    .sms_preview{width: 276px; height: 553px; background: url(/assets/images/iphone.png) center top no-repeat; margin: 100px auto; padding: 100px 30px}
    .sms_preview .inner {background: #e5e5ea;padding: 10px;	font-size: 11px;border-radius: 15px;margin-bottom: 10px;float: left; max-width: 100%;width: 100%;max-height:300px;overflow-y:auto;word-wrap: break-word;}
</style>
