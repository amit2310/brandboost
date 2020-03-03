<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{campaign.name}} </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.bc_status !='archive'" @click="changeCampaignStatus('0')"> Save as draft</button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="changeCampaignStatus('1')" >Publish <span><img
                            src="/assets/images/arrow-right-line.svg"></span>  </button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
            <loading :isLoading="loading"></loading>

            <div class="container-fluid">
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="email_config_list">
                                <li>
                                    <a class="active" href="javascript:void(0);"><span class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration</a></li>
                                <li><a class="" href="javascript:void(0);" @click="displayStep(2)" ><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>
                                    Integration</a></li>
<!--                                <li><a href="javascript:void(0);"  ><span class="num_circle"><span class="num">3</span><span-->
<!--                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Recipients</a>-->
<!--                                </li>-->
<!--                                <li><a href="javascript:void(0);" ><span class="num_circle"><span class="num">4</span><span-->
<!--                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Scores</a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="email_review_config p20">
                            <div class="bbot pb10 mb15">
                                <h2 class="fsize11 text-uppercase dark_200 m-0 ">
                                <a  class="fsize11 text-uppercase dark_200 m-0" href="javascript:void(0);" @click="SettingTabActive(1)">Configurations</a>
                                <a @click="SettingTabActive(2)" class="fsize11 text-uppercase dark_200 m-0  p10" href="javascript:void(0);">Design</a>
                                <a @click="SettingTabActive(3)" class="fsize11 text-uppercase dark_200 m-0  p10" href="javascript:void(0);">Reviews</a>
                                </h2>
                            </div>
                            <div v-if="settingTab ==1 ">
                                <div class="bbot pb10 mb15">
                                    <h2 class="fsize11 text-uppercase dark_200 m-0">DESIGN
                                        <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -195px;"></i>
                                    </h2>
                                </div>
                                <div class="p0">
                                    <div class="form-group">
                                        <label class="fsize13" for="fname">Template</label>

                                        <button id="galleryDesignType" type="button" class="btn h52 form-control w100 js-media-widget-slidebox1" style="text-align: left; padding: 7px 23px!important;">
                                            <span>Galley Type</span>
                                            <i class="pull-right txt_grey">
                                                <img src="/assets/images/icon_grid.svg">
                                            </i>
                                        </button>
                                    </div>
                                </div>
                                <div class="p0">
                                    <div class="form-group">
                                        <label class="fsize13" for="fname">Widget type</label>
                                        <select v-model="campaign.gallery_type" @change="synGalleryType($event)" class="form-control h52 autoSaveConfig" name="galleryType" id="galleryType">
                                            <option value="3">3 Images</option>
                                            <option value="4">4 Images</option>
                                            <option value="5">5 Images</option>
                                            <option value="6">6 Images</option>
                                            <option value="7">7 Images</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="p0">
                                    <div class="form-group">
                                        <label class="fsize13" for="fname">Image Size</label>
                                        <select class="form-control h52 autoSaveConfig" @change="synImageSize($event)" v-model="campaign.image_size" name="imageSize" id="imageSize">
                                            <option value="small">Small</option>
                                            <option value="medium">Medium</option>
                                            <option value="large">Large</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="bbot pb10 mb15">
                                    <h2 class="fsize11 text-uppercase dark_200 m-0">COMPONENTS
                                        <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -160px;"></i>
                                    </h2>
                                </div>
                                <div class="p0">
                                    <h3 class="dark_400 mb0 fsize13 fw300">Title &nbsp;
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="campaign.allow_title" :checked="campaign.allow_title" @change="synAllowTitle($event)">
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                    <h3 class="dark_400 mb0 fsize13 fw300">Arrows &nbsp;
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="campaign.allow_arrow" :checked="campaign.allow_arrow" @change="synAllowArrow($event)">
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                    <h3 class="dark_400 mb0 fsize13 fw300">Rating & reviews                                    &nbsp;
                                        <label class="custom-form-switch float-right">
                                            <input class=" field" type="checkbox" v-model="campaign.allow_ratings" :checked="campaign.allow_ratings" @change="synAllowRatings($event)">
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                </div>
                                <div class="btop bbot pb10 mb15 mt15">
                                    <h2 class="fsize11 text-uppercase dark_200 m-0">DETAILS
                                        <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -190px"></i>
                                    </h2>
                                </div>
                                <div class="p0">
                                    <div class="form-group">
                                        <label class="fsize13" for="fname">Gallery Name</label>
                                        <input type="text" v-model="campaign.name" class="form-control h40" id="fname" placeholder="Gallery Name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label class="fsize13" for="Questions">Gallery Description:</label>
                                        <textarea
                                            rows="4"
                                            class="form-control text"
                                            id="Questions"
                                            name="question"
                                            :placeholder="`Gallery Description`"
                                            v-model="campaign.description"

                                        ></textarea>
                                    </div>
                                </div>
                            </div>

                            <div v-if="settingTab ==2 ">
                                <div class="bbot pb10 mb15">
                                    <h2 class="fsize11 text-uppercase dark_200 m-0">BRANDING
                                        <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -195px;"></i>
                                    </h2>
                                </div>
                                <div class="p0">
                                    <h3 class="dark_400 mb0 fsize13 fw300">BORDER DROP-SHADOW
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="campaign.allow_border_shadow" :checked="campaign.allow_border_shadow" @change="synAllowBorderShadow($event)">
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                    <h3 class="dark_400 mb0 fsize13 fw300">BORDER COLOR
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="campaign.allow_widget_bgcolor" :checked="campaign.allow_widget_bgcolor" @change="synAllowWidgetBgcolor($event)">
                                            <span class="toggle email"></span> </label>
                                    </h3>
                                </div>
                                <div class="pt10">
                                    <div class="form-group">
                                        <label class="fsize13" for="fname">Border Thickness</label>
                                        <select v-model="campaign.border_thickness" @change="synBorderThickness($event)" class="form-control h52" name="borderThickness" id="border_thickness">
                                            <option value="1">1px</option>
                                            <option value="2">2px</option>
                                            <option value="3">3px</option>
                                            <option value="4">4px</option>
                                            <option value="5">5px</option>
                                            <option value="6">6px</option>
                                        </select>
                                    </div>
                                </div>
                                <h3 class="dark_400 mb0 fsize13 fw300">WIDGET COLOR
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="campaign.bg_color_type" :checked="campaign.bg_color_type =='on'" @change="synBgColorType($event)">
                                            <span class="toggle email"></span> </label>
                                            <span class="float-right pr10">Gradient </span>
                                </h3>
                                <div class="widgetMultiColorBox" v-if="campaign.bg_color_type =='on'">
                                    <div class="form-group">
                                        <div class="color_box">
                                            <input type="hidden" name="main_colors" id="main_colors"  :value="campaign.gradient_color">
                                            <div v-on:click="synMainColor('white')" class="color_cube white selectMainColor " :class="{ 'active' : campaign.gradient_color == 'white'}" color-class="bbw_white_color"></div>
                                            <div v-on:click="synMainColor('red')" class="color_cube dred selectMainColor " :class="{ 'active' : campaign.gradient_color == 'red'}"  color-class="bbw_red_color"></div>
                                            <div v-on:click="synMainColor('yellow')" class="color_cube yellow selectMainColor " :class="{ 'active' : campaign.gradient_color == 'yellow'}" color-class="bbw_yellow_color"></div>
                                            <div v-on:click="synMainColor('orange')" class="color_cube red selectMainColor " :class="{ 'active' : campaign.gradient_color == 'orange'}" color-class="bbw_orange_color"></div>
                                            <div v-on:click="synMainColor('green')" class="color_cube green selectMainColor " :class="{ 'active' : campaign.gradient_color == 'green'}" color-class="bbw_green_color"></div>
                                            <div v-on:click="synMainColor('blue')" class="color_cube blue selectMainColor " :class="{ 'active' : campaign.gradient_color == 'blue'}" color-class="bbw_blue_color"></div>
                                            <div v-on:click="synMainColor('purple')" class="color_cube black selectMainColor " color-data="purple" color-class="bbw_purple_color"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="row orientation_top" style="display:block">
                                    <div class="col-md-12">
                                        <div style="margin: 25px 0 15px!important;" class="profile_headings txt_upper fsize11 fw600">Choose orientation</div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" id="color_orientation" name="color_orientation" :value="campaign.gradient_orientation">
                                        <!-- gradient_orientation -->
                                        <ul class="choose_orientation">
                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.gradient_orientation == 'to right top'}" v-on:click="synGradientOrientation('to right top')" main-orientation-class="toRightTop" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.gradient_orientation == 'to right'}" v-on:click="synGradientOrientation('to right')"  main-orientation-class="toRight" href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.gradient_orientation == 'to right bottom'}" v-on:click="synGradientOrientation('to right bottom')"   main-orientation-class="toRightBottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.gradient_orientation == 'to bottom'}" v-on:click="synGradientOrientation('to bottom')"   main-orientation-class="toBottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.gradient_orientation == 'to left bottom'}" v-on:click="synGradientOrientation('to left bottom')" main-orientation-class="toLeftBottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.gradient_orientation == 'to left'}" v-on:click="synGradientOrientation('to left')"  main-orientation-class="toLeft" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.gradient_orientation == 'to left top'}" v-on:click="synGradientOrientation('to left top')"  main-orientation-class="toLeftTop" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.gradient_orientation == 'to top'}" v-on:click="synGradientOrientation('to top')"  main-orientation-class="toTop" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.gradient_orientation == 'circle'}" v-on:click="synGradientOrientation('circle')"  main-orientation-class="orientationCircle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                </div>

                                <div v-if="!campaign.bg_color_type" class="widgetMultiColorBox">
                                     <div class="col-md-12">
                                         <span class="fsize13 dark_400 mt-2">SOLID COLOR:</span>
                                        <input type="text"
                                           class="form-control colorpicker-basic2 float-right"
                                           name="solid_color"
                                           v-model="campaign.solid_color"
                                               @change="synSolidColor()"
                                         >
                                     </div>
                                </div>
                            </div>

                            <div v-if="settingTab ==3 ">
                                <div class="bbot pb10 mb15">
                                    <h2 class="fsize11 text-uppercase dark_200 m-0">SELECT REVIEWS
                                        <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -145px;"></i>
                                    </h2>
                                </div>
<!--{{campaign}}-->
                                <div class="form-group mb10" style="padding-bottom:8px; margin-bottom:8px; border-bottom:1px solid #f4f6fa;" v-for="review in reviewsData">
                                    <div class="pull-left mb0 showReviewPopup">
                                        <div>
                                             <div class="media-left pr-15">
                                                 <img class="review_productimg" src="review.id">
                                             </div>
                                             <div class="media-left pr0">
                                                <div>{{review.brand_title}}</div>
                                                    <div class="text-size-small text-muted" style="font-size:11px;"> {{review.review_title}}</div>
                                                </div>
                                                <div class="review_section_user">
                                                    <div class="top_div" style="border: none;">
                                                        <div class="left"><i class="circle"></i><a class="icons" href="javascript:void(0);"><span class="icons fl_letters s32">DM</span></a></div>
                                                        <div class="right">
                                                            <div class="client_n"><p>{{review.firstname}} {{review.lastname}}</p></div>
                                                                <div class="client_review">
                                                                    ratings
                                                                    
                                                                    <img src="/assets/images/widget/yellow_icon.png">
                                                                    <img src="/assets/images/widget/yellow_icon.png">
                                                                    <img src="http://brandboost.io/assets/images/widget/grey_icon.png">
                                                                    <img src="http://brandboost.io/assets/images/widget/grey_icon.png">
                                                                    <img src="http://brandboost.io/assets/images/widget/grey_icon.png">
                                                                    <span>June 27th 2019</span></div>
                                                                </div>
                                                    </div>
                                                </div>
                                             </div>
                                            </div>
<!--                                    v-model="findSelectedReview(review.id)"-->
                                            <label class="custom-form-switch pull-right">
                                                <input class="field"
                                                       type="checkbox"
                                                       id="review-" :id="review.id"
                                                       v-bind:value="review.id"
                                                        :checked="findSelectedReview(review.id)"
                                                       v-model="campaign.reviews_id"
                                                       @change="synReviewsId($event)">
<!--                                                <input class="field autoSaveReview" type="checkbox" id="widget_review_" :id="review.id" name="reviewsId[]" :value="review.id">-->
                                                <span class="toggle dred"></span>
                                            </label>
                                            <div class="clearfix"></div>
                                        </div>

                            </div>
                            <div class="col-12 pt-15">
                                <button class="btn btn-success btn-sm bkg_green_300 light_000 text-center" @click="synSolidColor">Save<span><img
                                    src="/assets/images/arrow-right-line.svg"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="email_review_config p20" style="width: 100% !important;">
                            <div class="bbot pb10 mb15">
                                <h2 class="fsize11 text-uppercase dark_200 m-0">Preview</h2>
                            </div>
                            <div class="card p0 m-auto text-center" v-html="preview">

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
                        <!--                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(2)">Continue <span><img-->
                        <!--                            src="/assets/images/arrow-right-line.svg"></span></button>-->
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="changeCampaignStatus('1')" >Publish <span><img
                            src="/assets/images/arrow-right-line.svg"></span>  </button>
                        <button class="btn btn-success btn-sm bkg_green_300 light_000 float-right mr-3" @click="updateConfigurations">Save Changes <span><img
                            src="/assets/images/arrow-right-line.svg"></span></button>
                    </div>
                </div>
            </div>
        </div>
        <!--Content Area End-->
        <!--******************
             Create Sliding Smart Popup
            **********************-->
        <div class="box" style="width: 550px;">
            <div style="width:550px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">
                    <a class="cross_icon js-media-widget-slidebox1">
                        <i class=""><img src="assets/images/cross.svg"/></i>
                    </a>
                    <form method="post" @submit.prevent="processForm">
                        <div class="p40">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <img src="assets/images/list-icon.svg"/> -->
                                    <h3 class="htxt_medium_13 dark_800 mt20">Choose Gallery Widget Design</h3>
                                    <p class="htxt_medium_12 dark_800 mt20">Choose type of item you want to create</p>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="row p30">
                                        <div class="col-md-6 review_source_new onerowCWBox" current-class="onerow">
                                            <label for="radiocheck_sp_1" v-on:change="synGalleryDesignType">
                                                <div style="min-height: 150px" class="inner " :class="{ 'active' : campaign.gallery_design_type == 'onerow'}">
                                                    <span class="custmo_checkbox checkboxs">
                                                        <input :checked="campaign.gallery_design_type == 'onerow'" id="radiocheck_sp_1" type="radio" name="widgetDesignType" class="selectwidget1" value="onerow" v-model="campaign.gallery_design_type">
                                                        <span class="custmo_checkmark purple"></span>
                                                    </span>
                                                    <figure>
                                                        <img src="http://brandboost.io/assets/images/media_inline_4.png">
                                                    </figure>
                                                    <div class="text_sec">
                                                        <p><strong>Single Row Gallery</strong></p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="col-md-6 review_source_new squareCWBox" current-class="square">
                                            <label for="radiocheck_sp_2" v-on:change="synGalleryDesignType">
                                            <div style="min-height: 150px" class="inner " :class="{ 'active' : campaign.gallery_design_type == 'square'}">
                                                    <span class="custmo_checkbox checkboxs">
                                                        <input :checked="campaign.gallery_design_type == 'square'" id="radiocheck_sp_2" type="radio" name="widgetDesignType" v-model="campaign.gallery_design_type" class="selectwidget1" value="square">
                                                        <span class="custmo_checkmark purple"></span>
                                                    </span>
                                                    <figure><img src="http://brandboost.io/assets/images/media_square_4.png"></figure>
                                                    <div class="text_sec">
                                                        <p><strong>Square Gallery</strong></p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        </div>
                                    <div class="row p30">
                                        <div class="col-md-6 review_source_new horizontalCWBox" current-class="horizontal">
                                            <label for="radiocheck_sp_3" v-on:change="synGalleryDesignType">
                                                <div style="min-height: 150px" class="inner " :class="{ 'active' : campaign.gallery_design_type == 'horizontal'}">
									<span class="custmo_checkbox checkboxs">
										<input :checked="campaign.gallery_design_type == 'horizontal'" id="radiocheck_sp_3" type="radio" v-model="campaign.gallery_design_type" name="widgetDesignType" class="selectwidget1" value="horizontal">
										<span class="custmo_checkmark purple"></span>
									</span>
                                                    <figure><img src="http://brandboost.io/assets/images/media_square_6.png"></figure>
                                                    <div class="text_sec">
                                                        <p><strong>Horizontal Gallery</strong></p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="col-md-6 review_source_new verticalCWBox" current-class="vertical">
                                            <label for="radiocheck_sp_4" v-on:change="synGalleryDesignType">
                                                <div style="min-height: 150px" class="inner " :class="{ 'active' : campaign.gallery_design_type == 'vertical'}">
									<span class="custmo_checkbox checkboxs">
										<input :checked="campaign.gallery_design_type == 'vertical'" id="radiocheck_sp_4" type="radio" v-model="campaign.gallery_design_type" name="widgetDesignType" class="selectwidget1" value="vertical">
										<span class="custmo_checkmark purple"></span>
									</span>

                                                    <figure><img src="http://brandboost.io/assets/images/media_square_6_vert.png"></figure>
                                                    <div class="text_sec">
                                                        <p><strong>Vertical Gallery</strong></p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row bottom-position">
                                <div class="col-md-12 mb15">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="editGalleryId" id="editGalleryId" value="campaign.id"/>

                                    <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Save</button>
                                    <a class="blue_300 fsize16 fw600 ml20" href="#">Close</a> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import jq from 'jquery';
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
                settingTab :3,
                campaignId: this.$route.params.id,
                reviewsData: {},
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
            this.getMediaWidgetSetup();
        },
        mounted() {
            setTimeout(function(){
                loadNPSJQScript(35);
            }, 500);

        },
        computed: {

        },
        methods: {

            getMediaWidgetSetup: function(){
                axios.get('/admin/mediagallery/setup/' + this.campaignId)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaign = response.data.galleryData;
                        this.reviewsData = response.data.reviewsData;
                        this.preview = response.data.setupPreview;
                        this.loading = false;
                        // this.formLabel = 'Update';
                        this.displayForm(this.campaign);
                    });
            },
            findSelectedReview: function(findId){
                console.log(this.campaign.reviews_id);
                if(this.campaign.reviews_id) {
                    var length = this.campaign.reviews_id.length;
                    for(var i = 0; i < length; i++) {
                            console.log(this.campaign.reviews_id[i]);
                            if(this.campaign.reviews_id[i] == findId)
                                return true;
                    }
                }

                // return true;
            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/modules/mediagallery/';
                }else{
                    path = '/admin#/modules/mediagallery/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
            },
            synAllowTitle: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_title',1);

                }else{
                    this.updateSingleField('allow_title',0);
                }
            },
            SettingTabActive: function(e){
                this.settingTab =e;
            },
            synAllowArrow: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_arrow',1);

                }else{
                    this.updateSingleField('allow_arrow',0);
                }
            },
            synAllowRatings: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_ratings',1);

                }else{
                    this.updateSingleField('allow_ratings',0);
                }
            },
            synAllowBorderShadow: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_border_shadow',1);

                }else{
                    this.updateSingleField('allow_border_shadow',0);
                }
            },
            synBgColorType: function(e){
                if(e.target.checked){
                    this.updateSingleField('bg_color_type','on');

                }else{
                    this.updateSingleField('bg_color_type','');
                }
            },
            synAllowWidgetBgcolor: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_widget_bgcolor',1);

                }else{
                    this.updateSingleField('allow_widget_bgcolor',0);
                }
                $(".colorpicker-basic2").spectrum();
            },
            synBorderThickness: function(e){
                this.updateSingleField('border_thickness',this.campaign.border_thickness);

            },
            synGalleryType: function(e){
                this.updateSingleField('gallery_type',this.campaign.gallery_type);

            },
            synImageSize: function(e){
                this.updateSingleField('image_size',this.campaign.image_size);

            },
            synMainColor: function(e){
                this.updateSingleField('gradient_color',e);
            },
            synGradientOrientation: function(e){
                this.updateSingleField('gradient_orientation',e);
            },
            synSolidColor: function(e){
                let elem1 = document.querySelector('input[name="solid_color"]');
                let solid_color = (elem1 != null) ? elem1.value : null;
                // console.log(solid_color);
                this.campaign.solid_color = solid_color ? solid_color : this.campaign.solid_color;
                this.updateSingleField('solid_color',this.campaign.solid_color);
            },
            synGalleryDesignType:function(){
                this.loading =true;
                this.updateSingleField('gallery_design_type',this.campaign.gallery_design_type);
                document.querySelector('.js-media-widget-slidebox1').click();
            },
            updateSingleField: function (fieldName, fieldValue) {
                this.loading = true;
                axios.post('admin/mediagallery/updateSingleField', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    gallery_id: this.campaignId,
                }).then(response => {
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.getMediaWidgetSetup();
                    this.loading = false;
                });

            },
            synReviewsId: function () {
                var fieldName = 'reviews_id';
                var fieldValue=this.campaign.reviews_id;
                this.loading = true;
                axios.post('admin/mediagallery/updateSingleFieldCompress', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    gallery_id: this.campaignId,
                }).then(response => {
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.getMediaWidgetSetup();
                    this.loading = false;
                });

            },

            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                // document.querySelector('.js-media-widget-slidebox').click();
            },
            updateConfigurations: function(){
                this.loading = true;
                //Grab color related values
                let elem1 = document.querySelector('input[name="web_text_color"]');
                let elem2 = document.querySelector('input[name="web_int_text_color"]');
                let elem3 = document.querySelector('input[name="web_button_text_color"]');
                let elem4 = document.querySelector('input[name="web_button_over_text_color"]');
                let elem5 = document.querySelector('input[name="web_button_color"]');
                let web_text_color = (elem1 != null) ? elem1.value : null;
                let web_int_text_color = (elem2 != null) ? elem2.value : null;
                let web_button_text_color = (elem3 != null) ? elem3.value : null;
                let web_button_over_text_color = (elem4 != null) ? elem4.value : null;
                let web_button_color = (elem5 != null) ? elem5.value : null;
                this.campaign.web_text_color = web_text_color ? web_text_color : this.campaign.web_text_color;
                this.campaign.web_int_text_color = web_int_text_color ? web_int_text_color : this.campaign.web_int_text_color;
                this.campaign.web_button_text_color = web_button_text_color ? web_button_text_color : this.campaign.web_button_text_color;
                this.campaign.web_button_over_text_color = web_button_over_text_color ? web_button_over_text_color : this.campaign.web_button_over_text_color;
                this.campaign.web_button_color = web_button_color ? web_button_color : this.campaign.web_button_color;

                //Brand logo
                let brandlogo = document.querySelector('input[name="brand_logo"]');
                this.campaign.brand_logo = (brandlogo != null) ? brandlogo.value : this.campaign.brand_logo;

                axios.post('/admin/mediagallery/updateMediaWidget', this.campaign)
                    .then(response => {
                        this.getMediaWidgetSetup();
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
                axios.post('/admin/mediagallery/updateGallery', {
                    _token: this.csrf_token(),
                    title: this.campaign.title,
                    description: this.campaign.description,
                    editGalleryId: this.campaignId,
                }).then(response => {
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.loading = false;
                    this.getMediaWidgetSetup();
                });

            },
            changeCampaignStatus: function(status){
                this.loading = true;
                axios.post('admin/mediagallery/updateStatus', {
                    gallery_id: this.campaignId,
                    status: status,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if(response.data.status == 'success'){
                            if(status == '0'){
                                this.successMsg = 'Campaign saved as a draft successfully';
                            }
                            if(status == '1'){
                                this.successMsg = 'Campaign is active now';
                            }

                        }else{
                            this.errorMsg = 'Something went wrong';
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
        $(".colorpicker-basic2").spectrum();
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

        $(document).ready(function () {
            $(document).on('click', '.js-media-widget-slidebox1', function () {
                $(".box").animate({
                    width: "toggle"
                });
            });
            // $(document).on('click', '.selectMainColor', function () {
            //     $('#main_colors').val($(this).attr('color-data'));
            // });
        });




    }

</script>
<style scoped>
    .email_config_list li{
        width: 24.5% !important;
    }
    .email_review_config{
        width:300px !important;
        position: relative !important;
    }
</style>



