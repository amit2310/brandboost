<template>
    <div class="reviews_workflows">
        <!--******************
  Top Heading area
 **********************-->
        <div class="top-bar-top-section bbot shadow4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        &nbsp;
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <!--<button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"></button>-->
                        <button class="btn btn-md bkg_reviews_400 light_000 float-right">Save</button>
                        <div class="float-right mr-4">
                            <p class="fsize14 dark_600 m-0 float-left mr-3" style="line-height:33px;">Active </p>
                            <label class="custom-form-switch mt-2">
                                <input class="field" type="checkbox" checked="">
                                <span class="toggle green3"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--******************
         Content Area
        **********************-->
        <div class="content-area pt20">
            <div class="container-fluid">

                <!--******************
                 PAGE LEFT SIDEBAR
                **********************-->
                <a class="close_sidebar" href="javascript:void(0);">&nbsp; <img src="assets/images/menu-2-line.svg"></a>
                <div class="page_sidebar bkg_light_000 fixed">
                    <div style="width: 279px;">
                        <div class="p20 bbot top_headings bkg_light_000">
                            <div class="row">
                                <div class="col"><p>WORKFLOW</p></div>
                            </div>
                        </div>

                        <div class="p20 bkg_light_000 shadow4 min_h_65">
                            <div class="row">
                                <div class="col"><p class="fsize12 fw500 dark_200 text-uppercase m-0">Nodes</p></div>
                                <div class="col text-right"><p class="fsize14 fw400 dark_300 m-0"><img width="16" src="assets/images/list_check2.svg"/> &nbsp; Flow View</p></div>
                            </div>
                        </div>

                        <div class="p30 workflow_list_box">
                            <ul class="workflow_list_new">
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 br35 bkg_dark_100 "><i class="ri-play-fill"></i></span> Start</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_blue_400"><i class="ri-price-tag-3-fill"></i></span> Triger: People Tag</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_email_400"><i class="ri-mail-open-fill"></i></span> Email: Sale campaign #1</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_email_400"><i class="ri-mail-open-fill"></i></span> Email: Thank you campaign...</a></li>
                                <li class="buttons text-center">
                                    <div class="workflow_switch_div_small" style="z-index:9">
                                        <a class="workflow_switch" href="javascript:void(0);"><i class="ri-git-merge-fill"></i> SPLIT </a>
                                        <a class="workflow_switch active" href="javascript:void(0);">50/50</a>
                                    </div>
                                </li>


                                <li><a href="javascript:void(0);"><span class="circle-icon-20 br35 bkg_dark_100">A</span> Variant A</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_sms_400"><i class="ri-message-3-line"></i></span> SMS: Greeting</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_blue_400"><i class="ri-message-3-line"></i></span> Request: SMS Request</a></li>


                                <li><hr></li>

                                <li><a href="javascript:void(0);"><span class="circle-icon-20 br35 bkg_dark_100">B</span> Variant A</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_email_400"><i class="ri-mail-open-fill"></i></span> Email: Greeting</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_reviews_400"><i class="ri-mail-open-fill"></i></span> Request: Email Request</a></li>

                                <li class="buttons text-center">
                                    <div class="workflow_switch_div_small" style="z-index:9">
                                        <a class="workflow_switch" href="javascript:void(0);"><i class="ri-add-line"></i> MERGE </a>
                                    </div>
                                </li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_blue_400"><i class="ri-price-tag-3-fill"></i></span> Tag: Review</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_blue_400"><i class="ri-folder-fill"></i></span> List: Customers</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 br35 bkg_dark_100"><i class="ri-check-fill"></i></span> End</a></li>

                            </ul>
                        </div>






                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--******************
                 PAGE LEFT SIDEBAR END
                **********************-->

                <div class="row mb20">
                    <div class="col"><button class="circle-icon-32 bkg_reviews_400 mr15 shadow4 float-left slideActionbox"><img src="assets/images/plus_white_10.svg"></button>
                        <div class="workflow_switch_div float-left" v-if="viewType=='canvas'">
                            <a class="workflow_switch" href="javascript:void(0);"><i class="ri-arrow-left-line"></i></a>
                            <a class="workflow_switch" href="javascript:void(0);"><i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="workflow_switch_div float-right">
                            <a class="workflow_switch" :class="{'active': viewType == 'list'}" href="javascript:void(0);" @click="viewType='list'"><i class="ri-list-check-2"></i> List view</a>
                            <a class="workflow_switch" :class="{'active': viewType == 'canvas'}" href="javascript:void(0);" @click="viewType='canvas'"><i class="ri-drag-move-line"></i> Canvas</a>
                        </div>
                    </div>
                </div>

                <!--List View-->
                <div class="row" v-show="viewType=='list'">
                    <div class="col-12">
                        <div class="card p35  mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 br12 bkg_blue_400 light_000 d-block fsize16 fw500 rotate45"><i class="ri-price-tag-3-fill"></i></span></div>
                                <div class="col-9">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">Triger: Tag</h3>
                                    <ul class="review_camapaign_list">
                                        <li><span>Tag</span><strong><i class="ri-add-circle-fill green_400"></i> New Customer</strong></li>
                                        <li><span>Contacts</span><strong>1,356</strong></li>
                                    </ul>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card p35  mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 br12 bkg_email_300 light_000 d-block fsize16 fw500"><i class="ri-mail-open-fill"></i></span></div>
                                <div class="col-9">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">Email: Sale campaign #1</h3>
                                    <ul class="review_camapaign_list">
                                        <li><span><figure><img src="assets/images/Create_Ema_preview.png"></figure></span><strong>
                                            <strong>Max Iver  &nbsp; &nbsp;   iver.mdx@brandboost.com</strong><br>
                                            <strong>Hello <strong class="reviews_400">[Fist name]</strong>, It was a pleasure doing business with you...</strong>
                                            <a href="javascript:void(0);">Preview Template “Review Request Email”</a><br>
                                            <a href="javascript:void(0);">Send test email</a>
                                        </strong></li>
                                    </ul>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card p35  mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 br12 bkg_email_300 light_000 d-block fsize16 fw500"><i class="ri-mail-open-fill"></i></span></div>
                                <div class="col-9">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">Email: Thank you campaign</h3>
                                    <ul class="review_camapaign_list">
                                        <li><span><figure><img src="assets/images/Create_Ema_preview.png"></figure></span><strong>
                                            <strong>Max Iver  &nbsp; &nbsp;   iver.mdx@brandboost.com</strong><br>
                                            <strong>Hello <strong class="reviews_400">[Fist name]</strong>, It was a pleasure doing business with you...</strong>
                                            <a href="javascript:void(0);">Preview Template “Review Request Email”</a><br>
                                            <a href="javascript:void(0);">Send test email</a>
                                        </strong></li>
                                    </ul>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt20 mb30">
                        <div class="col-12">
                            <div class="p0 text-center">
                                <div class="workflow_switch_div_small mb20" style="z-index:9">
                                    <a class="workflow_switch" href="javascript:void(0);"><i class="ri-git-merge-fill"></i> SPLIT </a>
                                    <a class="workflow_switch active" href="javascript:void(0);">50/50</a>
                                </div>
                                <button class="circle-icon-32 bkg_light_000 blue_200 shadow4" style="z-index:9; position:relative">A</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card p35  mb10">
                            <div class="row">
                                <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 last br12 bkg_sms_400 light_000 d-block fsize16 fw500"><i class="ri-message-3-line"></i></span></div>
                                <div class="col-9">
                                    <h3 class="htxt_medium_16 dark_700 mb-2">SMS: Greeting</h3>
                                    <ul class="review_camapaign_list">
                                        <li>
    						<span class="smsbox" style="margin-bottom:30px;">
    							<div class="row mb-1">
    								<div class="col"><p class="m-0 fsize8 light_700"><img src="assets/images/message_icon_green.svg" width="10"> &nbsp; MESSAGES</p></div>
    								<div class="col text-right"><p class="m-0 fsize8 light_700">now</p></div>
    							</div>
    							<p class="fsize9 fw500 dark_900 mb-1">Makers</p>
    							<p class="fsize9 fw300 dark_900 m-0">Hello Julia, It was a pleasure doing business with you. Thank you for giving us a try. You can click this link to leave your review...</p>
    						</span>

                                            <strong><strong>Max Iver  &nbsp; &nbsp;   iver.mdx@brandboost.com</strong><br>
                                                Hello <strong class="reviews_400">[Fist name]</strong>, It was a pleasure doing business with you... <br>
                                                <a href="javascript:void(0);">Preview SMS Template “Review Request”</a><br>
                                                <a href="javascript:void(0);">Send test SMS</a>
                                            </strong></li>
                                    </ul>
                                </div>
                                <div class="col text-right">
                                    <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Canvas View-->
                <div class="row" v-show="viewType=='canvas'">
                    <div class="col-md-12 mb-3">

                        <div class="workflow_box">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <span class="link_button_32 bkg_light_800 wf_play_btn bot_line_50"><img src="assets/images/play-fill-white-20.svg"></span>
                                </div>


                                <div class="col-md-12">
                                    <div class="workflow_card">
                                        <div class="wf_icons br8 bkg_blue_300"><img class="rotate-45" src="assets/images/price-tag-3-fill-16.svg"></div>
                                        <p class="dark_200 fsize11 fw500 mb-1 text-uppercase ls_4">Tag </p>
                                        <p class="dark_600 htxt_medium_14 mb15">New Customer </p>
                                        <div class="p0 pt12 btop">
                                            <ul class="workflow_list">
                                                <li style="border:none;"><a href="javascript:void(0);"><span><img src="assets/images/account-circle-fill-grey-16.svg"></span> 1,356</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="workflow_switch_div_small canvas mb0">
                                        <a class="workflow_switch" href="javascript:void(0);"><i class="ri-git-merge-fill"></i> SPLIT </a>
                                        <a class="workflow_switch active" href="javascript:void(0);">50/50</a>
                                    </div>
                                </div>


                                <div class="col-md-12"><img src="assets/images/wfline.png"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="workflow_card">
                                        <div class="wf_icons br12 bkg_email_300"><img src="assets/images/mail-open-fill-white-16.svg"></div>
                                        <p class="dark_200 fsize11 fw500 mb-1 text-uppercase ls_4">EMAIL </p>
                                        <p class="dark_600 htxt_medium_14 mb15">Sale Campaign #1 </p>
                                        <div class="p0 pt12 btop">
                                            <ul class="workflow_list">
                                                <li><a href="javascript:void(0);"><span><img src="assets/images/send-plane-2-fill.svg"></span> 28%</a></li>
                                                <li><a href="javascript:void(0);"><span><img src="assets/images/cursor_fill_16.svg"></span> 12%</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="workflow_card">
                                        <div class="edit_delete">
                                            <a href="javascript:void(0);"><i class="icon-gear fsize12 dark_100"></i></a>
                                            <a href="javascript:void(0);"><i class="icon-bin2 fsize10 dark_100"></i></a>
                                        </div>

                                        <div class="wf_icons br12 bkg_sms_400"><img src="assets/images/sms-white-16.svg"></div>
                                        <p class="dark_200 fsize11 fw500 mb-1 text-uppercase ls_4">SMS </p>
                                        <p class="dark_600 htxt_medium_14 mb15">Sale Campaign #1 </p>
                                        <div class="p0 pt12 btop">
                                            <ul class="workflow_list">
                                                <li><a href="javascript:void(0);"><span><img src="assets/images/send-plane-2-fill.svg"></span> 28%</a></li>
                                                <li><a href="javascript:void(0);"><span><img src="assets/images/cursor_fill_16.svg"></span> 12%</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12"><img src="assets/images/wfline_reverse.png"></div>

                                <div class="col-md-12">
                                    <div class="workflow_switch_div_small canvas mt0">
                                        <a class="workflow_switch" href="javascript:void(0);"><i class="ri-git-merge-fill"></i> MERGE </a>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="workflow_card bot_line_50">
                                        <div class="wf_icons br12 bkg_blue_300"><img class="" src="assets/images/mail-open-fill-white-16.svg"></div>
                                        <p class="dark_200 fsize11 fw500 mb-1 text-uppercase ls_4">Tag </p>
                                        <p class="dark_600 htxt_medium_14 mb15">New Customer </p>
                                        <div class="p0 pt12 btop">
                                            <ul class="workflow_list">
                                                <li><a href="javascript:void(0);"><span><img src="assets/images/send-plane-2-fill.svg"></span> 28%</a></li>
                                                <li><a href="javascript:void(0);"><span><img src="assets/images/cursor_fill_16.svg"></span> 12%</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>

                </div>

                 <div class="box actionBoxContent" style="width: 424px; display:none;">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideActionbox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img src="assets/images/addnote44.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Add Node </h3>
                                        <hr class="mt30 mb30">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-flashlight-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Action</p>
                                            <p class="fw400 fsize12 dark_300 m0">Perform an action, such as add tag or send single email</p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10">
                                            <span class="circle-icon-44 bkg_yellow_500 m-auto br12 "><i class="ri-mail-open-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Decision</p>
                                            <p class="fw400 fsize12 dark_300 m0">Send people down a single path based on selected criteria.</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10">
                                            <span class="circle-icon-44 bkg_reviews_300 m-auto  "><i class="ri-time-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Delay</p>
                                            <p class="fw400 fsize12 dark_300 m0">Wait for a given period of time before continue down the path</p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10">
                                            <span class="circle-icon-44 bkg_email_300 m-auto br12 "><img src="assets/images/split.svg"/></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Split Test</p>
                                            <p class="fw400 fsize12 dark_300 m0">Split trafic to determine which is the most effective</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-6 pr5 text-center d-flex">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 col">
                                            <span class="circle-icon-44 bkg_sms_400 m-auto "><i class="ri-checkbox-circle-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Goal</p>
                                            <p class="fw400 fsize12 dark_300 m0">Define a goal that will pull people to this point when achived</p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl5 text-center d-flex">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 col">
                                            <span class="circle-icon-44 bkg_dark_100 m-auto "><i class="ri-flag-2-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Exit</p>
                                            <p class="fw400 fsize12 dark_300 m0">Exit the path<br> the person <br> is currently on.</p>
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
    export default {
        data(){
            return {
                viewType: 'list'
            }
        },
        methods: {

        }
    }
    $(document).ready(function(){
        $(".slideActionbox").click(function(){
            $(".actionBoxContent").animate({
                width: "toggle"
            });
        });
    });
</script>




