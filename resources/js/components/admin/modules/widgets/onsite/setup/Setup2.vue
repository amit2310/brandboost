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
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20" v-if="this.campaign.status !='3'" @click="saveDraft"> Save as draft</button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(3)"> Next <span style="opacity: 1"><img
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
                                <li><a class="active"   href="javascript:void(0);" @click="displayStep(2)"><span class="num_circle"><span class="num">2</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Statistics</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div style="margin: 0;" class="panel panel-flat">

                            <div class="panel-body p15">
                                <div class="panel-title">
                                    <h6 class="fsize11 text-uppercase dark_200 m-0 ">
                                        <a  class="fsize11 text-uppercase dark_200 m-0" href="javascript:void(0);" @click="SettingTabActive(1)">Configurations</a>
                                        <a @click="SettingTabActive(2)" class="fsize11 text-uppercase dark_200 m-0  p8" href="javascript:void(0);">Design</a>
                                        <a @click="SettingTabActive(3)" class="fsize11 text-uppercase dark_200 m-0" href="javascript:void(0);">Campaigns</a>
                                    </h6>
                                </div>
                                <hr/>
                                <!--                            {{oBrandboostList}}-->
                                <div class="embed-responsive">
                                    <div v-if="settingTab ==1 ">
                                        <div class="bbot pb10 mb15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">Configurations
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -195px;"></i>
                                            </h2>
                                        </div>
                                        <div class="p0">
                                            <div class="form-group">
                                                <label class="fsize13" for="galleryDesignType">Template</label>
                                                <button id="galleryDesignType" type="button" class="btn h52 form-control w100 js-media-widget-slidebox1" style="text-align: left; padding: 7px 23px!important;">
                                                    <span>Horizontal Popup</span>
                                                    <i class="pull-right txt_grey">
                                                        <img src="/assets/images/icon_grid.svg">
                                                    </i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="bbot pb10 mb15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">COMPONENTS
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -160px;"></i>
                                            </h2>
                                        </div>
                                        <div class="p0">
                                            <h3 class="dark_400 mb0 fsize13 fw300">Comments &nbsp;
                                                <label class="custom-form-switch float-right">
                                                    <input class="field" type="checkbox" v-model="campaign.allow_comments" :checked="campaign.allow_comments" @change="synAllowComment($event)">
                                                    <span class="toggle email"></span> </label>
                                            </h3>
                                            <h3 class="dark_400 mb0 fsize13 fw300">Video Reviews &nbsp;
                                                <label class="custom-form-switch float-right">
                                                    <input class="field" type="checkbox" v-model="campaign.allow_video_reviews" :checked="campaign.allow_video_reviews" @change="synAllowVideoReviews($event)">
                                                    <span class="toggle email"></span> </label>
                                            </h3>
                                            <h3 class="dark_400 mb0 fsize13 fw300">Helpful Feedback                                    &nbsp;
                                                <label class="custom-form-switch float-right">
                                                    <input class=" field" type="checkbox" v-model="campaign.allow_helpful_feedback" :checked="campaign.allow_helpful_feedback" @change="synAllowHelpful($event)">
                                                    <span class="toggle email"></span> </label>
                                            </h3>
                                            <h3 class="dark_400 mb0 fsize13 fw300">People Currently Reading
                                                <label class="custom-form-switch float-right">
                                                    <input class="field" type="checkbox" v-model="campaign.allow_live_reading_review" :checked="campaign.allow_live_reading_review" @change="synAllowLiveReading($event)">
                                                    <span class="toggle email"></span> </label>
                                            </h3>
                                            <h3 class="dark_400 mb0 fsize13 fw300">Comment Rating &nbsp;
                                                <label class="custom-form-switch float-right">
                                                    <input class="field" type="checkbox" v-model="campaign.allow_comment_ratings" :checked="campaign.allow_comment_ratings" @change="synAllowRatings($event)">
                                                    <span class="toggle email"></span> </label>
                                            </h3>
                                            <h3 class="dark_400 mb0 fsize13 fw300">Review Date Stamps                                    &nbsp;
                                                <label class="custom-form-switch float-right">
                                                    <input class=" field" type="checkbox" v-model="campaign.allow_review_timestamp" :checked="campaign.allow_review_timestamp" @change="synAllowTimestamp($event)">
                                                    <span class="toggle email"></span> </label>
                                            </h3>
                                            <h3 class="dark_400 mb0 fsize13 fw300">Alternative Design &nbsp;
                                                <label class="custom-form-switch float-right">
                                                    <input class="field" type="checkbox" v-model="campaign.alternative_design" :checked="campaign.alternative_design" @change="synAlternativeDesign($event)">
                                                    <span class="toggle email"></span> </label>
                                            </h3>
                                            <h3 class="dark_400 mb0 fsize13 fw300">Display Campaign Name                                    &nbsp;
                                                <label class="custom-form-switch float-right">
                                                    <input class=" field" type="checkbox" v-model="campaign.allow_campaign_name" :checked="campaign.allow_campaign_name" @change="synAllowCampaignName($event)">
                                                    <span class="toggle email"></span> </label>
                                            </h3>
                                        </div>


                                        <div class="btop bbot pb10 mb15 mt15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">BRAND BOOST DETAILS
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -190px"></i>
                                            </h2>
                                        </div>
                                        <div class="p0">
                                            <div class="form-group">
                                                <label class="fsize13" for="domain_name">Domain</label>
                                                <input type="text" v-model="campaign.domain_name"
                                                       @change="updateSettings('domain_name', $event.target.value, 'brandboost')"
                                                       class="form-control h40" id="domain_name" placeholder="https://google.com/">
                                            </div>
                                        </div>
                                        <div class="p0">
                                            <div class="form-group">
                                                <label class="fsize13" for="brand_title">Brand Boost Name</label>
                                                <input type="text" v-model="campaign.brand_title"
                                                       @change="updateSettings('brand_title', $event.target.value, 'brandboost')"
                                                       class="form-control h40" id="brand_title" placeholder="New Product on Site Boost" name="brand_title">
                                            </div>
                                        </div>
                                        <div class="p0">
                                            <div class="form-group">
                                                <label for="company_logo" class="fsize12 fw300">Company logo</label>
                                                <input type="hidden" id="company_logo" name="company_logo" @click="updateSettings('company_logo', $event.target.value, 'brandboost')">
                                                <div class="img_vid_upload_small">
                                                    <div class="dropzone" id="myDropzone_CmpLogo"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p0">
                                            <div class="form-group">
                                                <label for="logo_img" class="fsize12 fw300">Product image</label>
                                                <input type="hidden" id="logo_img" name="logo_img" @click="updateSettings('logo_img', $event.target.value, 'brandboost')">
                                                <div class="img_vid_upload_small">
                                                    <div class="dropzone" id="myDropzone_logo_img"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="btop bbot pb10 mb15 mt15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">REVIEW SETTINGS
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -190px"></i>
                                            </h2>
                                        </div>

                                        <div class="p0">
                                            <div class="form-group">
                                                <label class="fsize13" for="brand_title">Reviews Order</label>
                                                <select v-model="campaign.reviews_order" @change="updateSettings('reviews_order', $event.target.value, 'brandboost')" class="form-control h52 autoSaveConfig"  id="reviews_order">
                                                    <option value="all" selected="">All Reviews</option>
                                                    <option value="top_rating">Top Rated Reviews</option>
                                                    <option value="lowest_rating">Lowest Rated Reviews</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="p0">
                                            <div class="form-group">
                                                <label class="fsize13" for="brand_title">Reviews Order By</label>
                                                <select v-model="campaign.reviews_order_by" @change="updateSettings('reviews_order_by', $event.target.value, 'brandboost')"  class="form-control h52" id="reviews_order_by">
                                                    <option value="all" selected="">All Reviews</option>
                                                    <option value="newest">Newest Reviews</option>
                                                    <option value="oldest">Oldest Reviews</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="p0">
                                            <div class="form-group">
                                                <label class="fsize13" for="num_of_review">Reviews display</label>
                                                <input v-model="campaign.num_of_review" min="0" type="number" @change="updateSettings('num_of_review', $event.target.value, 'brandboost')"  class="form-control h52" id="num_of_review" />
                                            </div>
                                        </div>
                                        <div class="p0">
                                            <div class="form-group">
                                                <label class="fsize13" for="often_bb_display">How often to show widget</label>
                                                <input v-model="campaign.often_bb_display" min="0" type="number" @change="updateSettings('often_bb_display', $event.target.value, 'brandboost')"  class="form-control h52" id="often_bb_display" />
                                            </div>
                                        </div>
                                        <div class="p0">
                                            <div class="form-group">
                                                <label class="fsize13" for="min_ratings_display">Minimum rating to display</label>
                                                <input v-model="campaign.min_ratings_display" min="0" max="5" type="number" @change="updateSettings('min_ratings_display', $event.target.value, 'brandboost')"  class="form-control h52" id="min_ratings_display" />
                                            </div>
                                        </div>

                                    </div>


                                    <div v-if="settingTab ==2 ">
                                        <div class="bbot pb10 mb15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">WIDGET APPEARANCE
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -195px;"></i>
                                            </h2>
                                        </div>

                                        <div class="p0">
                                            <div class="form-group">
                                                <label class="control-label">Widget Position</label>
                                                <select class="form-control h52 autoSaveDesign widgetPosition" v-model="campaign.widget_position" id="widget_position" style="display: none;">
                                                    <option value="bottom-left" selected="">Left</option>
                                                    <option value="bottom-right">Right</option>
                                                </select>
                                                <div class="form-control h52">
                                                    <span v-if="campaign.widget_position =='bottom-right'">Bottom Right</span>
                                                    <span v-if="campaign.widget_position =='bottom-left'">Bottom Left</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Widget Theme</label>
                                                <select class="form-control h52" @change="updateSettings('widget_themes', $event.target.value, 'brandboost')"  v-model="campaign.widget_themes" id="widget_themes">
                                                    <option v-for="wtheme in widgetThemeData" :value="wtheme.id">{{wtheme.widget_theme_title}}</option>
                                                </select>
                                            </div>
                                            <div class="bbot pb10 mb15">
                                                <h2 class="fsize11 text-uppercase dark_200 m-0">WIDGET STYLE
                                                    <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -195px;"></i>
                                                </h2>
                                            </div>
                                            <h3 class="dark_400 mb0 fsize13 fw300">WIDGET COLOR
                                                <label class="custom-form-switch float-right">
                                                    <input class="field" type="checkbox" v-model="campaign.header_color_solid"
                                                           @change="synWidgetColor($event)">
                                                    <span class="toggle email"></span> </label>
                                                <span class="float-right pr10">Gradient </span>
                                            </h3>
                                            <div  v-if="campaign.header_color_solid"  class="widgetMultiColorBox">
                                                <div class="form-group">
                                                    <div class="color_box">
                                                        <div v-on:click="synMainColor('white')" class="color_cube white " :class="{ 'active' : campaign.header_color == 'white'}"></div>
                                                        <div v-on:click="synMainColor('red')" class="color_cube dred " :class="{ 'active' : campaign.header_color == 'red'}"></div>
                                                        <div v-on:click="synMainColor('yellow')" class="color_cube yellow " :class="{ 'active' : campaign.header_color == 'yellow'}"></div>
                                                        <div v-on:click="synMainColor('orange')" class="color_cube red " :class="{ 'active' : campaign.header_color == 'orange'}"></div>
                                                        <div v-on:click="synMainColor('green')" class="color_cube green " :class="{ 'active' : campaign.header_color == 'green'}"></div>
                                                        <div v-on:click="synMainColor('blue')" class="color_cube blue " :class="{ 'active' : campaign.header_color == 'blue'}"></div>
                                                        <div v-on:click="synMainColor('purple')" class="color_cube black " :class="{ 'active' : campaign.header_color == 'purple'}"></div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="row orientation_top" style="display:block">
                                                    <div class="col-md-12">
                                                        <div style="margin: 25px 0 15px!important;" class="profile_headings txt_upper fsize11 fw600">CHOOSE ORIENTATION</div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <ul class="choose_orientation">
                                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.color_orientation == 'to right top'}" v-on:click="synGradientOrientation('to right top')" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.color_orientation == 'to right'}" v-on:click="synGradientOrientation('to right')"  href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.color_orientation == 'to right bottom'}" v-on:click="synGradientOrientation('to right bottom')" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.color_orientation == 'to bottom'}" v-on:click="synGradientOrientation('to bottom')"   href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.color_orientation == 'to left bottom'}" v-on:click="synGradientOrientation('to left bottom')"  href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.color_orientation == 'to left'}" v-on:click="synGradientOrientation('to left')"  href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.color_orientation == 'to left top'}" v-on:click="synGradientOrientation('to left top')" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.color_orientation == 'to top'}" v-on:click="synGradientOrientation('to top')"  href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                                                            <li><a class="gradientOrientation " :class="{ 'active' : campaign.color_orientation == 'circle'}" v-on:click="synGradientOrientation('circle')"  href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="!campaign.header_color_solid" class="widgetMultiColorBox">
                                                <div class="col-md-12">
                                                    <span class="fsize13 dark_400 mt-2">SOLID COLOR:</span>
                                                    <input style="display: none;" type="hidden"
                                                           class="form-control colorpicker-basic2 float-right"
                                                           name="rating_solid_color"
                                                           v-model="campaign.rating_solid_color">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="btop bbot mt15 pb10 pt10 mb15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">FONT COLOR
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -195px;"></i>
                                            </h2>
                                        </div>
                                        <div class="pb10 mb15">

                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control float-right"
                                                           readonly
                                                           :value="campaign.widget_font_color">
                                                </div>
                                                <div class="col-sm-5">
                                                    <input style="display: none;" type="hidden"
                                                           class="form-control colorpicker-basic3 float-right"
                                                           name="widget_font_color"
                                                           v-model="campaign.widget_font_color">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btop bbot mt15 pb10 pt10 mb15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">BORDER LINE COLOR
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -195px;"></i>
                                            </h2>
                                        </div>
                                        <div class="pb10 mb15">

                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control float-right"
                                                           readonly
                                                           :value="campaign.widget_border_color">
                                                </div>
                                                <div class="col-sm-5">
                                                    <input style="display: none;" type="hidden"
                                                           class="form-control colorpicker-basic4 float-right"
                                                           name="widget_border_color"
                                                           v-model="campaign.widget_border_color">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btop bbot mt15 pb10 pt10 mb15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">RATING STYLE
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -195px;"></i>
                                            </h2>
                                        </div>
                                        <div class="pb10 mb15">

                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control float-right"
                                                           readonly
                                                           :value="campaign.widget_border_color">
                                                </div>
                                                <div class="col-sm-5">
                                                    <input style="display: none;" type="hidden"
                                                           class="form-control colorpicker-basic5 float-right"
                                                           name="widget_border_color"
                                                           v-model="campaign.widget_border_color">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btop bbot mt15 pb10 pt10 mb15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">BRANDING
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -160px;"></i>
                                            </h2>
                                        </div>
                                        <div class="p0">
                                            <h3 class="dark_400 mb0 fsize13 fw300">Hide Brand Boost branding &nbsp;
                                                <label class="custom-form-switch float-right">
                                                    <input class="field" type="checkbox" v-model="campaign.allow_branding" :checked="campaign.allow_branding" @change="synAllowBranding($event)">
                                                    <span class="toggle email"></span> </label>
                                            </h3>
                                        </div>
                                        <div class="btop bbot mt15 pb10 pt10 mb15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">SAVE WIDGET THEME SETTINGS
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -160px;"></i>
                                            </h2>
                                        </div>
                                        <div class="p0">
                                            <div class="form-group">
                                                <input type="text" v-model="widgetNewTheme.widget_theme_title" class="form-control h40" id="widget_theme_title" placeholder="Create Widget Theme" name="widget_theme_title">
                                            </div>
                                        </div>

                                    </div>

                                    <div v-if="settingTab ==3 ">
                                        <div class="bbot pb10 mb15">
                                            <h2 class="fsize11 text-uppercase dark_200 m-0">SELECT REVIEWS
                                                <i class="icon-arrow-down12 txt_grey fsize15 text-right" style="right: -145px;"></i>
                                            </h2>
                                        </div>
                                        <div class="form-group mb10" style="" v-for="review in oBrandboostList">
                                            <div class="p0">
                                                <h3 class="dark_400 mb0 fsize13 fw300">
                                                    {{review.brand_title}}
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field"
                                                               type="checkbox"
                                                               id="review-" :id="'review-'+review.id"
                                                                v-bind:value="review.id"
                                                               :checked="findSelectedReview(review.id)"
                                                               @change="synBrandboostId($event , review.id)">
                                                        <span class="toggle dred"></span>
                                                    </label>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 pt-15">
                                        <button class="btn btn-success btn-sm bkg_green_300 light_000 text-center saveWidgetDesign" @click="saveWidgetDesign" style="display: none"> <span><img
                                            src="/assets/images/arrow-right-line.svg"></span></button>
                                            <button class="btn btn-success btn-sm bkg_green_300 light_000 text-center saveWidgetTheme" @click="saveWidgetTheme">Save Widget Theme <span><img
                                            src="/assets/images/arrow-right-line.svg"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading p15">
                                <h6 class="panel-title">Statistic</h6>
                                <div class="widget_view_change_menu">
                                    <ul class="nav nav-tabs nav-tabs-bottom">
<!--                                        @click="setStatisticTab('Tablet')"-->
                                        <li><a  href="#Tabletver" data-toggle="tab"><i class="icon-tablet"></i> Tablet</a></li>
                                        <li><a href="#Phonever" data-toggle="tab"><i class="icon-mobile2"></i> Mobile</a></li>
                                        <li class="active"><a href="#Desktopver" data-toggle="tab"><i class="icon-display"></i> Desktop</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body p15">
                                <div class="embed-responsive embed-responsive-16by9d">
                                    <div  v-html="widget_preview">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                    <h3 class="htxt_medium_13 dark_800 mt20">Choose widget</h3>
                                    <p class="htxt_medium_12 dark_800 mt20">Choose type of item you want to create</p>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4 review_source_new bwwCWBox reviewWidgetBox">
                                            <label for="radiocheck1"  v-on:change="setWidgetType">
                                                <div class="inner" :class="{ 'active': campaign.widget_type == 'bww'}" >
                                    <span class="custmo_checkbox checkboxs">
                                        <input :checked="campaign.widget_type == 'bww'" v-model="campaign.widget_type" value="bww"   id="radiocheck1" type="radio" name="widgetList" class="selectwidget" widget-id="bww">
                                        <span class="custmo_checkmark purple"></span>
                                    </span>
                                                    <figure><img src="assets/images/review_source1_new.png"/></figure>
                                                    <div class="text_sec">
                                                        <p><strong>Small Popup</strong></p>
                                                        <h5>Displays reviews in a fixed vertical popup positioned on the left or right side</h5>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-4 review_source_new bfwCWBox reviewWidgetBox">
                                            <label for="radiocheck2" v-on:change="setWidgetType">
                                                <div class="inner" :class="{ 'active': campaign.widget_type == 'bfw'}">
                            <span class="custmo_checkbox checkboxs">
                                <input  :checked="campaign.widget_type == 'bfw'" value="bfw" v-model="campaign.widget_type"  id="radiocheck2" type="radio" name="widgetList" class="selectwidget" widget-id="bfw">
                                <span class="custmo_checkmark purple"></span>
                            </span>
                                                    <figure><img src="assets/images/review_source2_new.png"/></figure>
                                                    <div class="text_sec">
                                                        <p><strong>Horizontal Popup</strong></p>
                                                        <h5>Displays 4 latest review in a bottom fixed scrollable reviews panel</h5>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-4 review_source_new cpwCWBox reviewWidgetBox">
                                            <label for="radiocheck3" v-on:change="setWidgetType">
                                                <div class="inner" :class="{ 'active': campaign.widget_type == 'cpw'}">
                            <span class="custmo_checkbox checkboxs">
                                <input :checked="campaign.widget_type == 'cpw'" value="cpw" v-model="campaign.widget_type" id="radiocheck3" type="radio" name="widgetList" class="selectwidget" widget-id="cpw">
                                <span class="custmo_checkmark purple"></span>
                            </span>

                                                    <figure><img src="assets/images/review_source3_new.png"/></figure>
                                                    <div class="text_sec">
                                                        <p><strong>Center Popup</strong></p>
                                                        <h5>Displays reviews in a lightbox slider with full focus on the details</h5>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-4 review_source_new vpwCWBox reviewWidgetBox">
                                            <label for="radiocheck4" v-on:change="setWidgetType">
                                                <div class="inner" :class="{ 'active': campaign.widget_type == 'vpw'}">
                            <span class="custmo_checkbox checkboxs">
                                <input :checked="campaign.widget_type == 'vpw'" value="vpw" v-model="campaign.widget_type" id="radiocheck4" type="radio" name="widgetList" class="selectwidget" widget-id="vpw">
                                <span class="custmo_checkmark purple"></span>
                            </span>

                                                    <figure><img src="assets/images/review_source4_new.png"/></figure>
                                                    <div class="text_sec">
                                                        <p><strong>Vertical Popup</strong></p>
                                                        <h5>Displays reviews in a scrollable feed component on page</h5>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-4 review_source_new rfwCWBox reviewWidgetBox">
                                            <label for="radiocheck5" v-on:change="setWidgetType">
                                                <div class="inner"  :class="{ 'active': campaign.widget_type == 'rfw'}">
                                <span class="custmo_checkbox checkboxs">
                                    <input :checked="campaign.widget_type == 'rfw'"  value="rfw" v-model="campaign.widget_type" id="radiocheck5" type="radio" name="widgetList" class="selectwidget" widget-id="rfw">
                                    <span class="custmo_checkmark purple"></span>
                                </span>
                                                    <figure><img src="assets/images/review_source5_new.png"/></figure>
                                                    <div class="text_sec">
                                                        <p><strong>Embeded Reviews</strong></p>
                                                        <h5>Displays reviews in a lightbox slider with full focus on the details</h5>
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
                                    <a class="blue_300 fsize16 fw600 ml20 js-media-widget-slidebox1">Close</a> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        title: 'Onsite Widgets - Brand Boost',
        data() {
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: true,
                settingTab:1,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                widget_type: '',
                widget_preview: '',
                campaignId: this.$route.params.id,
                campaign: {},
                user: {},
                breadcrumb: '',
                oBrandboostList: '',
                widgetThemeData: '',
                widgetNewTheme: {
                    widget_theme_title:'',
                },
                fromNumber: '',
                displayCustomLinkExpiry: false
            }
        },

        mounted() {
            this.widgetID = this.$route.params.id;
            this.widget_type = this.$route.params.id;
            this.getWidgetDetails();
            setTimeout(function () {
                loadNPSJQScript(35);
            },1000)
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
            SettingTabActive: function(e){
                this.settingTab =e;
                loadNPSJQScript(35);
            },
            saveWidgetTheme: function () {
                this.widgetNewTheme.theme_main_colors =this.campaign.header_color;
                this.widgetNewTheme.theme_custom_colors1 =this.campaign.theme_custom_colors1;
                this.widgetNewTheme.theme_custom_colors2 =this.campaign.theme_custom_colors2;
                this.widgetNewTheme.theme_solid_color ='';
                this.widgetNewTheme.theme_bg_color_switch =this.campaign.header_color_fix;
                this.widgetNewTheme.theme_main_colors_rating =this.campaign.rating_color;
                this.widgetNewTheme.theme_rating_custom_color1 =this.campaign.rating_custom_color1;
                this.widgetNewTheme.theme_rating_custom_colors2 =this.campaign.rating_custom_color2;
                this.widgetNewTheme.theme_rating_solid_color =this.campaign.rating_solid_color;
                this.widgetNewTheme.theme_fix_rating_color =this.campaign.rating_color_fix;
                this.widgetNewTheme.theme_widget_font_color =this.campaign.widget_font_color;
                this.widgetNewTheme.theme_widget_border_color =this.campaign.widget_border_color;
                this.widgetNewTheme.theme_widget_position =this.campaign.widget_position;
                this.widgetNewTheme.theme_color_orientation =this.campaign.color_orientation;
                this.widgetNewTheme.theme_widget_id =this.campaign.id;

                axios.post('/admin/brandboost/createBrandBoostWidgetTheme',this.widgetNewTheme)
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

                        this.loading = false;

                    });
            },
            findSelectedReview: function(findId){
                console.log(this.campaign.brandboost_id +'dddddddd'+findId);
                if(this.campaign.brandboost_id == findId) {
                   return true
                }

                return false;
            },
            setWidgetType:function(){
                this.loading =true;
                axios.post('/admin/brandboost/set-widget-type',{
                    widgetID: this.$route.params.id,
                    widgetTypeID: this.campaign.widget_type,
                }).then(response => {
                    // console.log(response.data.status);
                    this.getWidgetDetails();
                    if(response.data.status =='success'){
                        this.successMsg="Setting has beeb saved successfully.";
                    }
                    this.loading =false;
                });
            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/widgets/onsite';
                }else{
                    path = '/admin#/widgets/onsite/setup/'+this.campaignId+'/'+step;
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
            saveWidgetDesign: function(e){
                let elem1 = document.querySelector('input[name="rating_solid_color"]');
                let solid_color = (elem1 != null) ? elem1.value : null;
                this.campaign.solid_color_rating = solid_color ? solid_color : this.campaign.rating_solid_color;
                let elem2 = document.querySelector('input[name="widget_font_color"]');
                let font_color = (elem2 != null) ? elem2.value : null;
                this.campaign.widget_font_color = font_color ? font_color : this.campaign.widget_font_color;
                let elem3 = document.querySelector('input[name="widget_border_color"]');
                let border_color = (elem3 != null) ? elem3.value : null;
                this.campaign.widget_border_color = border_color ? border_color : this.campaign.widget_border_color;
                this.loading = true;

                axios.post('/admin/brandboost/addBrandBoostWidgetDesign', this.campaign).then(response => {
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.getWidgetDetails();
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
                axios.post('/admin/brandboost/saveOnsiteWidgetSingleSettings', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    widgetID: this.campaignId,
                }).then(response => {
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.getWidgetDetails();
                    this.loading = false;
                });

            },
            updateSingleField: function (fieldName, fieldValue,  type) {
                this.loading = true;

                if(type =='expiry'){
                    this.displayCustomLinkExpiry = fieldValue == 'custom' || fieldName =='txtInteger' || fieldName =='exp_duration' ? true : false;
                }
                axios.post('/admin/brandboost/saveOnsiteWidgetSingleSettings', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    widgetID: this.campaignId,
                }).then(response => {
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.getWidgetDetails();
                    this.loading = false;
                });

            },
            saveDraft: function(){
                this.loading = true;
                axios.post('/admin/brandboost/updateOnsiteWidgetStatus', {
                    widgetID: this.campaignId,
                    status: '3',
                    current_state: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if(response.data.status == 'success'){
                            this.successMsg = 'Campaign saved as a draft successfully';
                        }else{
                            this.errorMsg = 'Something went wrong';
                        }
                    });
            },

            synWidgetColor: function(e){
                if(e.target.checked){
                    this.updateSingleField('header_color_solid',1);

                }else{
                    this.updateSingleField('header_color_solid',0);
                }
            },
            synAllowComment: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_comments',1);

                }else{
                    this.updateSingleField('allow_comments',0);
                }
            },
            synAllowBranding: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_branding',1);

                }else{
                    this.updateSingleField('allow_branding',0);
                }
            },
            synAllowVideoReviews: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_video_reviews',1);

                }else{
                    this.updateSingleField('allow_video_reviews',0);
                }
            },
            synAllowHelpful: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_helpful_feedback',1);

                }else{
                    this.updateSingleField('allow_helpful_feedback',0);
                }
            },
            synAllowLiveReading: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_live_reading_review',1);

                }else{
                    this.updateSingleField('allow_live_reading_review',0);
                }
            },
            synAllowRatings: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_comment_ratings','on');

                }else{
                    this.updateSingleField('allow_comment_ratings','');
                }
            },
            synAllowTimestamp: function(e){
                if(e.target.checked){
                    this.updateSingleField('allow_review_timestamp',1);

                }else{
                    this.updateSingleField('allow_review_timestamp',0);
                }

            },
            synAlternativeDesign: function(e){
                if(e.target.checked){
                    this.updateSingleField('alternative_design',1);

                }else{
                    this.updateSingleField('alternative_design',0);
                }
            },
            synBrandboostId: function(e,value){
                if(e.target.checked){
                    this.updateSingleField('brandboost_id',value)

                }else{
                    this.updateSingleField('brandboost_id','')
                }

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
                this.updateSingleField('header_color',e);
            },
            synGradientOrientation: function(e){
                this.updateSingleField('color_orientation',e);
            },

            synGalleryDesignType: function(e){
                this.updateSingleField('gradient_orientation',e);
            },

        }
    }
    function loadNPSJQScript(userid){
        var tkn = $('meta[name="_token"]').attr('content');
        /*$(".colorpicker-basic1").spectrum();
        $(".colorpicker-basic2").spectrum();
        $(".colorpicker-basic3").spectrum();
        $(".colorpicker-basic4").spectrum();*/
        //
        // var sliderBoxCount =  6;
        // var slideIndex = 0;
        // showSlides(1);
        $(".colorpicker-basic1").spectrum();
        $(".colorpicker-basic1").spectrum({
            change: function (color) {
                $('.colorpicker-basic1').val(color.toHexString());
            },
            move: function (color) {
                $('.colorpicker-basic1').val(color.toHexString());
            }
        });
        $(".colorpicker-basic2").spectrum();
        $(".colorpicker-basic2").spectrum({
            change: function (color) {
                // console.log('change'+color.toHexString());
                $('.colorpicker-basic2').val(color.toHexString());
                setTimeout(function () {
                    $('.saveWidgetDesign').trigger('click');
                }, 1000);
            },
            move: function (color) {
                // console.log('Move'+color.toHexString());
                $('.colorpicker-basic2').val(color.toHexString());
                setTimeout(function () {
                    $('.saveWidgetDesign').trigger('click');
                }, 1000);
            }
        });
        $(".colorpicker-basic3").spectrum();
        $(".colorpicker-basic3").spectrum({
            change: function (color) {
                $('.colorpicker-basic3').val(color.toHexString());
                setTimeout(function () {
                    $('.saveWidgetDesign').trigger('click');
                }, 1000);
            },
            move: function (color) {
                $('.colorpicker-basic3').val(color.toHexString());
                setTimeout(function () {
                    $('.saveWidgetDesign').trigger('click');
                }, 1000);
            }
        });
        $(".colorpicker-basic4").spectrum();
        $(".colorpicker-basic4").spectrum({
            change: function (color) {
                $('.colorpicker-basic4').val(color.toHexString());
                setTimeout(function () {
                    $('.saveWidgetDesign').trigger('click');
                }, 1000);
            },
            move: function (color) {
                $('.colorpicker-basic4').val(color.toHexString());
                setTimeout(function () {
                    $('.saveWidgetDesign').trigger('click');
                }, 1000);
            }
        });
        $(".colorpicker-basic5").spectrum();
        $(".colorpicker-basic5").spectrum({
            change: function (color) {
                $('.colorpicker-basic4').val(color.toHexString());
                setTimeout(function () {
                    $('.saveWidgetDesign').trigger('click');
                }, 1000);
            },
            move: function (color) {
                $('.colorpicker-basic4').val(color.toHexString());
                setTimeout(function () {
                    $('.saveWidgetDesign').trigger('click');
                }, 1000);
            }
        });
        $(document).ready(function () {
            $(document).on('click', '.js-media-widget-slidebox1', function () {
                $(".box").animate({
                    width: "toggle"
                });
            });
            $(document).on('click', '.reviewArrowBH a', function (e) {
                var bd = $(this).attr("bb_direction");
                if (bd == 'right') {
                    showSlides(1)
                } else if (bd == 'left') {
                    showSlides(-1)
                }
            });

            $(document).on('click', '.showReviewPopup', function (e) {
                e.preventDefault();

                $('.overlaynew').show();
                var reviewId = $(this).attr('review-id');
                $.ajax({
                    url: "/admin/mediagallery/getReviewData",
                    method: "get",
                    data: {'review_id': reviewId},
                    dataType: "json",
                    success: function (data) {
                        $('.overlaynew').hide();
                        if (data.status == "success") {
                            $('#reviewPopupData').html(data.popupData);
                            $('#reviewPopupModal').modal();
                        } else {
                            displayMessagePopup('error');
                        }
                    }
                });
            });
        });
        var tkn = $('meta[name="_token"]').attr('content');
        Dropzone.autoDiscover = false;
        if($('#myDropzone_CmpLogo').length) {
            var myDropzoneCmpLogoImg = new Dropzone(
                '#myDropzone_CmpLogo', //id of drop zone element 1
                {
                    url: '/dropzone/upload_s3_attachment/' + userid + '/onsite',
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
                            $('#company_logo').val(response.xhr.responseText);
                            $('#company_logo').click();

                        }

                    }
                });
            myDropzoneCmpLogoImg.on("complete", function (file) {
                myDropzoneCmpLogoImg.removeFile(file);
            });

        }
        if($('#myDropzone_logo_img').length) {
            var myDropzoneLogoImg = new Dropzone(
                '#myDropzone_logo_img', //id of drop zone element 1
                {
                    url: '/dropzone/upload_s3_attachment/' + userid + '/onsite',
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

    }
</script>





