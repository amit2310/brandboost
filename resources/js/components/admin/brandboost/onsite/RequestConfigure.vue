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
                        <h3 class="htxt_medium_24 dark_700">Review Campaign</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="btn btn-md bkg_light_800 light_000" :disabled="progressRate<96" :class="{'bkg_reviews_400': progressRate > 95}" @click="sendReviewRequest">Send Request <span><img
                            src="assets/images/arrow-right-circle-fill-white.svg"></span></button>
                        <button id="displayOverviewPreviewForm" type="button" style="display:none;">Display Edit & Preview</button>
                        <button id="hideOverviewPreviewForm" type="button" style="display:none;">Hide</button>
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

                <!--******************
             PAGE LEFT SIDEBAR
            **********************-->
                <a class="close_sidebar" href="javascript:void(0);">&nbsp; <img src="assets/images/menu-2-line.svg"></a>
                <div class="page_sidebar bkg_light_000 fixed">
                    <div style="width: 279px;">
                        <div class="p20 bbot top_headings">
                            <div class="row">
                                <div class="col"><p>REVIEW request</p></div>
                            </div>
                        </div>

                        <div class="p30 pb10 text-center">
                            <div id="chart_07">
                                <apexchart type=radialBar height=170 :options="chartOptions" :series="series" />
                            </div>
                        </div>
                        <div class="p30 pb15">
                            <div class="row">
                                <div class="col-9">
                                    <p class="htxt_medium_12 dark_200 ls_4 m-0 ml20">EMAIL REQUESTS</p>
                                </div>

                            </div>
                            <ul class="list_review mt-3">
                                <li><a :class="progressClass('audience')" @click="openForm('audience')" href="javascript:void(0);">Recipients</a></li>
                                <li><a :class="progressClass('sender')" @click="openForm('sender')" href="javascript:void(0);">From</a></li>
                                <li><a :class="progressClass('subject')" @click="openForm('subject')" href="javascript:void(0);">Email Subject</a></li>
                                <li><a :class="progressClass('content')" @click="openForm('content')" href="javascript:void(0);">Content</a></li>
                                <li><a :class="progressClass('tracking')" @click="openForm('tracking')" href="javascript:void(0);">Settings & Tracking</a></li>

                            </ul>
                        </div>

                        <div class="reviw_howtouse" v-if="showHelp">
                            <a href="javascript:void(0);" class="close_x_icon2" @click="showHelp=false"><img src="assets/images/close_grey_line.svg"/></a>
                            <p class="fsize12 fw300 light_000">Learn how to use <br><strong>Requests</strong> in 60
                                seconds</p>
                            <img src="assets/images/review_play.svg"/></div>


                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--******************
                  PAGE LEFT SIDEBAR END
                 **********************-->
                <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
                <template v-if="configureCampaign">
                    <div class="table_head_action pb0 mb15">
                        <div class="row">
                            <div class="col">
                                <h3 class="htxt_medium_14 dark_600">Email request</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card p35 br6 mb10" :class="{'disabled': disableAudienceForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                    <span v-if="completedAudienceForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500">
                                        <i class="ri-check-line"></i>
                                    </span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">1</span>
                                    </div>
                                    <div :class="`${displayAudienceForm == true ? 'col' : 'col-9'}`">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">Recipients</h3>
                                        <ul class="review_camapaign_list" v-if="completedAudienceForm==true && displayAudienceForm==false">
                                            <li><span>Recipients</span><strong> <img src="assets/images/addcirclegreen.svg">
                                                &nbsp; Core Subscribers List </strong></li>
                                            <li><span>Exclude</span><strong><img src="assets/images/minus_red.svg"> &nbsp;
                                                Spam Tag</strong></li>
                                        </ul>
                                        <p class="htxt_regular_14 dark_400 m-0 ls4" v-else>Who are you sending your request to?</p>
                                    </div>
                                    <div class="col text-right" v-if="displayAudienceForm==true">
                                        <!--<button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none">Add sender</button>-->
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" @click="closeForm('audience')">Cancel</button>
                                        <button class="btn br35 light_000 fsize13 fw500 p10 pl30 pr30 shadow-none bkg_green_400 ml20">Save</button>
                                    </div>
                                    <div class="col text-right" v-if="displayAudienceForm==false">
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" v-if="completedAudienceForm" @click="openForm('audience')"> Edit</button>
                                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none" v-else @click="openForm('audience')">
                                            Add recipients
                                        </button>
                                    </div>
                                </div>
                                <div class="btop mt30 pt30" v-show="displayAudienceForm==true">
                                    <choose-audience v-if="moduleName !=''" :moduleName="moduleName" :moduleUnitId="moduleUnitID"></choose-audience>
                                </div>
                            </div>

                            <div class="card p35 br6 mb10" :class="{'disabled': disableSenderForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                        <span v-if="completedSenderForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">2</span>
                                    </div>
                                    <div :class="`${displaySenderForm == true ? 'col' : 'col-9'}`">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">Default From</h3>
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
                                                    <option :value="senderForm.from_email">{{senderForm.from_email}}</option>
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
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">3</span>
                                    </div>
                                    <div :class="`${displaySubjectForm == true ? 'col' : 'col-9'}`">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">Default Subject</h3>
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

                            <div class="card p35 br6 mb10" :class="{'disabled': disableContentForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                        <span v-if="completedContentForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">4</span>
                                    </div>
                                    <div :class="`${displayContentForm == true ? 'col' : 'col-9'}`">

                                        <h3 class="htxt_medium_16 dark_700 mb-2">Default Content</h3>
                                        <ul class="review_camapaign_list" v-if="completedContentForm ==true && displayContentForm==false">
                                            <li><span><figure><img src="assets/images/Create_Ema_preview.png"></figure></span><strong><a href="javascript:void(0);" @click="loadEmailPreview">Preview Template “Review Request Email”</a> <br>
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
                                        <button class="btn border br35 reviews_400 fsize13 fw500 p10 pl30 pr30 shadow-none" v-else @click="loadEmailPreview">Edit content</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card p35 br6 mb10" :class="{'disabled': disableTrackingForm == true}">
                                <div class="row">
                                    <div style="max-width: 64px" class="col mt-1">
                                        <span v-if="completedTrackingForm" class="circle-icon-36 bkg_reviews_000 reviews_400 d-block fsize16 fw500"><i class="ri-check-line"></i></span>
                                        <span v-else class="circle-icon-36 bkg_light_200 light_000 d-block dark_100 fsize16 fw500">5</span>
                                    </div>
                                    <div :class="`${displayTrackingForm == true ? 'col' : 'col-9'}`">
                                        <h3 class="htxt_medium_16 dark_700 mb-2">Default Settings & Tracking</h3>
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
                </template>

            </div>
        </div>
        <!--******************
        Content Area End
        **********************-->
        <div class="modal fade show" id="EditOverviewPreview">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 1200px;">
                <div class="modal-content review" style="width: 1200px;">
                    <div class="modal-body p0 mt0 br5" style="width: 1200px;">
                        <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
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

    </div>

</template>

<script>
    import jq from "jquery";
    import ChooseAudience from '@/components/admin/manual_workflow/ChooseAudience';
    export default {
        components: {
            ChooseAudience,
            apexchart: VueApexCharts,
        },
        data() {
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
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
                request: {},
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                fromNumber: '',
                subscribers: {},
                displayCustomLinkExpiry: false,
                displayAudienceForm: false,
                displaySenderForm: false,
                displaySubjectForm: false,
                displayContentForm: false,
                displayTrackingForm: false,
                displaySMSSenderForm: false,
                displaySMSContentForm: false,
                displaySMSTrackingForm: false,
                displayAudienceForm: false,
                completedAudienceForm: false,
                completedSenderForm: false,
                completedSubjectForm: false,
                completedContentForm: false,
                completedTrackingForm: false,
                completedSMSSenderForm: false,
                completedSMSContentForm: false,
                completedSMSTrackingForm: false,
                disableAudienceForm: false,
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
                    requestType: 'sender',
                    requestId: this.$route.params.id,
                    from_name: '',
                    from_email: ''
                },
                subjectForm: {
                    _token: this.csrf_token(),
                    requestType: 'subject',
                    requestId: this.$route.params.id,
                    subject: '',
                    preheader: ''
                },
                trackingForm: {
                    _token: this.csrf_token(),
                    requestType: 'tracking',
                    requestId: this.$route.params.id,
                    tracking_conversation: '',
                    tracking_google_analytics: '',
                    tracking_open_read: '',
                    tracking_expire_link : '',
                },
                senderSMSForm: {
                    _token: this.csrf_token(),
                    requestType: 'feedback',
                    requestId: this.$route.params.id,
                    from_name: '',
                    sms_sender: ''
                },
                subjectForm: {
                    _token: this.csrf_token(),
                    requestType: 'subject',
                    requestId: this.$route.params.id,
                    subject: '',
                    preheader: ''
                },
                trackingForm: {
                    _token: this.csrf_token(),
                    requestType: 'tracking',
                    requestId: this.$route.params.id,
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
                progressRate: 0,
                sendTestBox: false,
                addedAudience: false,
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
        watch: {
            greetings: function(){
                jq("#wf_edit_template_greeting_EDITOR").text(this.greetings);
            },
            introduction: function(){
                jq("#wf_edit_template_introduction_EDITOR").text(this.introduction);
            },
        },
        created() {
            this.loadCampaignSettings();
        },
        methods: {
            loadCampaignSettings: function(){
                axios.post('/admin/brandboost/getReviewRequest', {request_id:this.$route.params.id, _token: this.csrf_token()})
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.request = response.data.requestData;
                        this.subscribers = response.data.subscribers;
                        if(this.subscribers.total>0){
                            this.completedAudienceForm = true;
                        }
                        if(this.request.type == 'email'){
                            this.isEmailChannelActivated = true;
                        }
                        if(this.request.type == 'sms'){
                            this.isSMSChannelActivated = true;
                        }

                        this.fromNumber = this.mobileNoFormat(this.request.sms_from_number);
                        this.user = response.data.aUserInfo;
                        this.emailTemplates = this.request.html_content;
                        this.smsTemplates = this.request.sms_content;
                        this.loading = false;
                        //Set SenderForm fields
                        this.senderForm.from_name = this.request.email_from_name;
                        this.senderForm.from_email = this.request.email;

                        this.senderSMSForm.from_name = this.request.sms_from_name;
                        this.senderSMSForm.sms_sender = this.request.sms_from_number;

                        //Set SubjectForm fields
                        this.subjectForm.subject = this.request.subject;
                        this.subjectForm.preheader = this.request.preheader;
                        //Set Tracking fields
                        this.trackingForm.tracking_conversation = this.request.tracking_conversation;
                        this.trackingForm.tracking_google_analytics = this.request.tracking_google_analytics;
                        this.trackingForm.tracking_open_read = this.request.tracking_open_read;
                        this.trackingForm.tracking_expire_link = this.request.tracking_expire_link;
                        //Set Channel Status.
                        this.assignCampaignIds(this.request);
                        //Validate Step Completion
                        this.validateStepCompletion();
                    });
            },
            validateStepCompletion: function(){
                //Sender form
                this.completedAudienceForm = false;
                this.completedSenderForm = false;
                this.completedSubjectForm = false;
                this.completedTrackingForm = false;

                this.completedSMSSenderForm = false;
                this.completedSMSTrackingForm = false;
                let completedPercentage = 0;
                let offset = 0;
                if(this.isEmailChannelActivated && this.isSMSChannelActivated){
                    offset = 14;
                }else if(this.isEmailChannelActivated && this.isSMSChannelActivated == false){
                    offset = 20;
                }else if(this.isEmailChannelActivated == false && this.isSMSChannelActivated == true){
                    offset = 33;
                }else{
                    offset = 0;
                }

                if(this.isEmailChannelActivated == true){
                    if(this.subscribers.total > 0){
                        this.completedAudienceForm = true;
                        completedPercentage = completedPercentage + offset;
                    }
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

                    if(this.campaign.tracking_conversation || this.campaign.tracking_google_analytics || this.campaign.tracking_open_read || this.campaign.tracking_expire_link){
                        this.completedSMSTrackingForm = true;
                        completedPercentage = completedPercentage + offset;
                    }
                }



                this.progressRate = completedPercentage;
                this.series = [this.progressRate];

            },
            disableAllCards: function(form){
                this.disableAudienceForm = true;
                this.disableSenderForm = true;
                this.disableSubjectForm = true;
                this.disableContentForm = true;
                this.disableTrackingForm = true;
                if(form == 'audience'){
                    this.disableAudienceForm = false;
                }else if(form == 'sender'){
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
                this.disableAudienceForm = false;
                this.disableSenderForm = false;
                this.disableSubjectForm = false;
                this.disableContentForm = false;
                this.disableTrackingForm = false;

                this.disableSMSSenderForm = false;
                this.disableSMSContentForm = false;
                this.disableSMSTrackingForm = false;
            },
            progressClass: function(form){
                let className;
                let activeClassName;
                if(form == 'audience'){
                    className = this.displayAudienceForm == true ? 'active' : '';
                    activeClassName = this.completedAudienceForm ? 'done' : '';
                }else if(form == 'sender'){
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
                if(form == 'audience'){
                    this.displayAudienceForm = true;
                }else if(form == 'sender'){
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
                }else if(form == 'smsTracking'){
                    this.displaySMSTrackingForm = true;
                }
            },
            closeForm: function(form){
                this.resetAllForms();
                this.enableAllCards(form);
            },
            resetAllForms: function(){
                this.displayAudienceForm = false;
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
                axios.post('/admin/brandboost/updateReviewRequest', this.senderForm)
                    .then(response => {
                        if(response.data.status =='success'){
                            this.refreshMessage = Math.random();
                            this.successMsg = 'Updated the changes successfully!!';
                            this.loading = false;
                            this.closeForm('sender');
                            this.validateStepCompletion();
                        }
                    });

            },
            saveSubjectInfo: function(){
                this.loading = true;
                axios.post('/admin/brandboost/updateReviewRequest', this.subjectForm)
                    .then(response => {
                        if(response.data.status =='success'){
                            this.refreshMessage = Math.random();
                            this.successMsg = 'Updated the changes successfully!!';
                            this.loading = false;
                            this.closeForm('subject');
                            this.validateStepCompletion();
                        }
                    });
            },
            saveTrackingInfo: function(){
                this.loading = true;
                axios.post('/admin/brandboost/updateReviewRequest', this.trackingForm)
                    .then(response => {
                        if(response.data.status =='success'){
                            this.refreshMessage = Math.random();
                            this.successMsg = 'Updated the changes successfully!!';
                            this.loading = false;
                            this.closeForm('tracking');
                            this.validateStepCompletion();
                        }
                    });
            },
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
            saveEditChanges: function(){
                this.loading = true;
                axios.post('/admin/brandboost/updateReviewRequest', {
                    _token: this.csrf_token(),
                    requestType: 'content',
                    requestId: this.$route.params.id,
                    greeting: this.greetings,
                    introduction: this.introduction
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.loading = false;
                            this.refreshMessage = Math.random();
                            this.successMsg = "Saved changes successfully!";
                        }
                    });
            },
            assignCampaignIds: function(data){
                if(data.type == 'email'){
                    this.emailCampaignId = data.id;
                    this.completedContentForm = true;
                    this.validateStepCompletion();
                }else if(data.type == 'sms'){
                    this.smsCampaignId = data.id;
                    this.completedSMSContentForm = true;
                    this.validateStepCompletion();
                }
            },
            loadEmailPreview: function(){
                this.loading = true;
                axios.post('/admin/brandboost/previewRequest', {
                    _token: this.csrf_token(),
                    request_id: this.$route.params.id
                })
                    .then(response => {
                        this.loading = false;
                        this.content = response.data.content;
                        this.introduction = response.data.introduction;
                        this.greetings = response.data.greeting;
                    });
                document.querySelector('#displayOverviewPreviewForm').click();
            },
            sendTestEmail: function(){
                this.loading = true;
                axios.post('/admin/brandboost/sendRequestTestMail', {
                    _token: this.csrf_token(),
                    request_id: this.$route.params.id,
                    email: this.user.email
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.loading = false;
                            this.refreshMessage = Math.random();
                            this.successMsg = "Test email sent successfully!";
                        }
                    });
            },
            sendReviewRequest: function(){
                this.loading = true;
                axios.post('/admin/brandboost/sendManualReviewRequest', {
                    _token: this.csrf_token(),
                    request_id: this.$route.params.id
                })
                    .then(response => {
                        if(response.data.status =='success'){
                            this.refreshMessage = Math.random();
                            this.successMsg = 'Review request added to the queue for sending';
                            this.loading = false;
                        }
                        if(response.data.status == 'error'){
                            this.refreshMessage = Math.random();
                            this.errorMsg = response.data.msg;
                            this.loading = false;
                        }
                    });

            }
        }
    }
    $(document).ready(function(){
        $(document).on("click", "#displayOverviewPreviewForm", function(){
            $("#EditOverviewPreview").modal('show');
        })
        $(document).on("click", "#hideOverviewPreviewForm", function(){
            $("#EditOverviewPreview").modal('hide');
        })
    });
</script>
