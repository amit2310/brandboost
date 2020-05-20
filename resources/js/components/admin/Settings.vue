<template>

    <div class="content" id="masterContainer">

        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Brand Settings</h3>
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li :class="[ seletedTab === 1 ? 'active' : '' ]"><a @click="seletedTab=1" data-toggle="tab" style="cursor:pointer; padding: 5px;">General&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 2 ? 'active' : '' ]"><a @click="seletedTab=2" data-toggle="tab" style="cursor:pointer; padding: 5px;"> Preferences&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 3 ? 'active' : '' ]"><a @click="seletedTab=3" data-toggle="tab" style="cursor:pointer; padding: 5px;">Subscription & Credits&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 4 ? 'active' : '' ]"><a @click="seletedTab=4" data-toggle="tab" style="cursor:pointer; padding: 5px;">Billing&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 5 ? 'active' : '' ]"><a @click="seletedTab=5" data-toggle="tab" style="cursor:pointer; padding: 5px;">Notifications&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 6 ? 'active' : '' ]"><a @click="seletedTab=6" data-toggle="tab" style="cursor:pointer; padding: 5px;">Import&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 7 ? 'active' : '' ]"><a @click="seletedTab=7" data-toggle="tab" style="cursor:pointer;">Export</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div v-if="(seletedTab === '' || seletedTab === 1)" class="tab-pane " id="right-icon-tab0">
            <div class="clearfix">&nbsp;</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-flat review_ratings">
                        <form id="frmGeneralBusinessInfo" name="frmGeneralBusinessInfo" method="post">
                            <div class="panel-heading" style="padding: 10px;">
                                <h4  class="panel-title">Brand Info</h4>
                            </div>
                            <div class="panel-body p0">
                                <div class="bbot p30">
                                    <div class="brand_subs">
                                        <div class="row">
                                            <div class="col-md-7"><img width="24" class="pull-left mr-20" src="/assets/images/company_profile_dark.png"/><p class="mb0"><span class="text-muted">Current plan:</span> {{ oCurrentPlanData != '' ? oCurrentPlanData.level_name : '[No Data]' }}</p></div>
                                            <div class="col-md-5 text-right"><a style="text-decoration:underline;" class="txt_purple showSubPage" href="javascript:void(0);">Manage Subscription</a></div>
                                        </div>
                                    </div>
                                </div>
                                <!--====LOGO SETTINGS====-->
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Logo</p></div>
                                        <div class="col-md-2 brig"><img class="img-circle" id="brand_logo_image_preview" width="64" height="64" :src="oUser.company_logo ? 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+oUser.company_logo : '/assets/images/wakerslogo.png'"/></div>

                                        <div class="col-md-6 col-md-offset-1">
                                            <div class="form-group mb0">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-upload7"></i></span>
                                                    <div class="dropzone" id="myDropzone" style="min-height: 0px; width: 300px!important;"></div>
                                                    <div style="display: none;" id="uploadedSiteFiles"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="company_logo" name="company_logo" :value="oUser.company_logo">
                                </div>
                                <!--====GENERAL SETTINGS====-->
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">General Info</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Business name</label>
                                                <div class="">
                                                    <input name="company_name" class="form-control" required="" type="text" :value="oUser.company_name" placeholder="Wakers Inc.">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Country</label>
                                                <div class="">
                                                    <select class="form-control"  name="company_country" v-model="country">
                                                        <option v-for="country in countries" :value="country.country_code" :selected="country.country_code == company_country ? 'selected' : ''">
                                                            {{ country.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Business address</label>
                                                <span class="display-inline-block pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" id="business_address_dppa" :checked="(oUser.business_address_dppa) ? 'checked' : ''">
												<span class="toggle blue"></span>
											</label>
										</span>
                                                <div class="">
                                                    <input name="company_address" class="form-control" type="text" :value="oUser.company_address" placeholder="Kiev, Ukraine">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Phone number</label>
                                                <span class="display-inline-block pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" id="phone_no_dppa" :checked="oUser.phone_no_dppa == 1 ? 'checked' : ''">
												<span class="toggle blue"></span>
											</label>
										</span>
                                                <div class="">
                                                    <input name="company_phone" class="form-control" type="text" :value="oUser.company_phone" placeholder="+3 8063 612 53 69">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Website</label>
                                                <span class="display-inline-block pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" id="website_dppa" :checked="oUser.website_dppa == 1 ? 'checked' : ''">
												<span class="toggle blue"></span>
											</label>
										</span>
                                                <div class="">
                                                    <input name="company_website" class="form-control" type="text" :value="oUser.company_website" placeholder="www.wakers.co">
                                                </div>
                                            </div>
                                            <input class="field" name="business_address_dppa" type="hidden" :value="oUser.business_address_dppa">
                                            <input class="field" name="phone_no_dppa" type="hidden" :value="oUser.phone_no_dppa">
                                            <input class="field" name="website_dppa" type="hidden" :value="oUser.website_dppa">

                                        </div>
                                    </div>
                                </div>
                                <!--====SOCIAL SETTINGS====-->
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Socials</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Facebook</label>
                                                <div class="">
                                                    <input name="social_facebook" class="form-control" type="text" :value="oUser.social_facebook" placeholder="@wakers">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Instagram</label>
                                                <div class="">
                                                    <input name="social_instagram" class="form-control" type="text" :value="oUser.social_instagram" placeholder="@wakers.agency">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Twitter</label>
                                                <div class="">
                                                    <input name="social_twitter" class="form-control" type="text" :value="oUser.social_twitter" placeholder="@wakers">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Linkedin</label>
                                                <div class="">
                                                    <input name="social_linkedin" class="form-control" type="text" :value="oUser.social_linkedin" placeholder="@wakersco">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--====SAVE====-->
                                <div class="p30">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <!-- <button type="button" class="btn white_btn ml20 txt_purple" >Preview</span> </button> -->
                                            <button type="submit" class="btn dark_btn ml20 bkg_purple saveUserOtherInfo" ><span>Save</span> </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--====DELETE====-->
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading">
                            <h6 class="panel-title">Delete brand account</h6>
                        </div>
                        <div class="panel-body p0">
                            <div class="p30">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p>Please note:<br><span class="text-muted">If you delete your account, you won’t be able to reactive it later.</span></p>
                                    </div>
                                    <div class="col-md-7 text-right mt-20">
                                        <button type="button" class="btn white_btn ml20 txt_purple" ><span>Delete "Wakers" brand account</span> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat review_ratings">
                        <form id="frmGeneralBusinessInfo2" name="frmGeneralBusinessInfo2" method="post">
                            <div class="panel-heading" style="padding: 10px;">
                                <h4 class="panel-title">Public Profile</h4>
                            </div>
                            <div class="panel-body p0">
                                <div class="bbot p30">
                                    <div class="brand_subs" style="border-top:2px solid #9b83ff;">
                                        <div class="row">
                                            <div class="col-md-2 text-center mt10"><img src="/assets/images/public_profile.png"/></div>
                                            <div class="col-md-10">
                                                <p class="mb-20">Public profiles are free and increase your online presence and trust. Show reviews, photos and more on a pixel-prerfect, mobile-friendly brand page.</p>

                                                <a href="http://pleasereviewmehere.com/campaign/raymond-194" target="_blank"><button type="button" class="btn white_btn mr20 txt_purple" ><span>View example</span> </button></a>
                                                <button type="button" class="btn dark_btn mr20 bkg_purple" ><span>Set live now</span> </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Public profile link</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Shareable link to your public profile</label>

                                                <div class="input-group">
                                                    <input name="public_profile_link" class="form-control txt_purple" type="text" :value="oUser.public_profile_link" placeholder="https://zipbooks.com/brand/wakers">
                                                    <span class="input-group-addon"><i class="icon-link txt_grey"></i></span>
                                                    <span class="input-group-addon"><i class="icon-pencil txt_grey"></i></span>
                                                </div>
                                            </div>

                                            <p class="pull-left">Publish page <span class="text-muted">Last publication {{ displayDateFormat('M d, h:i A', oUser.updated)  }}</span></p>
                                            <label class="custom-form-switch pull-right">
                                                <input class="field" id="public_publish_page" type="checkbox" :checked="oUser.public_publish_page ? 'checked' : ''">
                                                <span class="toggle"></span>
                                            </label>
                                            <input class="field" name="public_publish_page" type="hidden" :value="oUser.public_publish_page">

                                        </div>
                                    </div>
                                </div>

                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Business info</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Business types</label>
                                                <div class="form-group-material">
                                                    <input name="company_type" class="form-control token-field" type="text" :value="oUser.company_type" placeholder="Business types">
                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Where you operate</label>
                                                <div class="">

                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label class="btn white_btn { oUser.company_operate_scope == 'worldwide' || oUser.company_operate_scope == '') ? 'txt_purple' : '' } h40 m0 width_170 changeBA1">
                                                            <input type="radio" name="company_operate_scope" id="company_operate_scope1" value="worldwide" :checked="(oUser.company_operate_scope == 'worldwide' || oUser.company_operate_scope == '') ? 'checked' : ''" ><i class="fa fa-globe"></i> Worldwide
                                                        </label>
                                                        <label class="btn white_btn { oUser.company_operate_scope == 'locally' ? 'txt_purple' : '' } h40 m0 width_170 changeBA1">
                                                            <input type="radio" name="company_operate_scope" id="company_operate_scope2" value="locally" :checked="oUser.company_operate_scope == 'locally' ? 'checked' : ''" ><i class="icon-location3"></i> Locally
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Working hours</label>
                                                <div class="">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label class="btn white_btn { (oUser.company_working_hours == '8' || oUser.company_working_hours == '') ? 'txt_purple' : '' } h40 m0 width_170 changeBA2">
                                                            <input type="radio" name="company_working_hours" id="company_working_hours1" value="8" :checked="(oUser.company_working_hours == '8' || oUser.company_working_hours == '') ? 'checked' : ''" >8 AM
                                                        </label>
                                                        <label class="btn white_btn h40 m0 width_170 { oUser.company_working_hours == '6' ? 'txt_purple' : '' } changeBA2">
                                                            <input type="radio" name="company_working_hours" id="company_working_hours2" value="6" @if :checked="(oUser.company_working_hours == '6') ? 'checked' : ''" >6 PM
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Description & SEO</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Business description</label>
                                                <div class="">
                                                    <textarea name="company_description" style="height:200px; resize:none;" class="form-control" placeholder="So strongly and metaphysically did I conceive of my situation then, that while earnestly watching his motions, I seemed distinctly to perceive that my own individuality was now merged in a joint stock company of two; that my free will had received a mortal wound; and that another's mistake or misfortune might plunge innocent me into unmerited disaster and death.">{{ oUser.company_description }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">SEO Keywords</label>
                                                <div class="">
                                                    <textarea name="company_seo_keywords" style="height:120px; resize:none;" class="form-control" placeholder="e.g. design, agency, studio, website design, web design, designer, logo, branding, ui, ux, webdesign, app design, website templates, user expirience, website dev">{{ oUser.company_seo_keywords }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p30">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <a href="http://pleasereviewmehere.com/campaign/raymond-194" target="_blank"><button type="button" class="btn white_btn ml20 txt_purple">Preview </button></a>
                                            <button type="submit" class="btn dark_btn ml20 bkg_purple">Save </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="seletedTab === 2" class="tab-pane " id="right-icon-tab1">
            <div class="clearfix">&nbsp;</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading" style="padding: 10px;">
                            <h4 class="panel-title">General Preferences</h4>
                        </div>
                        <form id="frmGeneralBusinessInfo3" name="frmGeneralBusinessInfo3" method="post">
                            <div class="panel-body p0">
                                <!--====GENERAL SETTINGS====-->
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">General</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Language</label>
                                                <div class="">
                                                    <select name="language" class="form-control">
                                                        <option value="english" :selected="oUser.language == 'english' ? 'selected' : ''" >English</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Main currency</label>
                                                <div class="">
                                                    <select name="currency" class="form-control">
                                                        <option value="USD" selected="selected">USD</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--====GENERAL SETTINGS====-->
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Date & time</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Time zone</label>
                                                <div class="">
                                                    <select name="timezone" class="form-control">
                                                        <option timeZoneId="1" gmtAdjustment="GMT-12:00" useDaylightTime="0" value="1" :selected="oUser.timezone == '1' ? 'selected' : ''" >(GMT-12:00) International Date Line West</option>
                                                        <option timeZoneId="2" gmtAdjustment="GMT-11:00" useDaylightTime="0" value="2" :selected="oUser.timezone == '2' ? 'selected' : ''" >(GMT-11:00) Midway Island, Samoa</option>
                                                        <option timeZoneId="3" gmtAdjustment="GMT-10:00" useDaylightTime="0" value="3" :selected="oUser.timezone == '3' ? 'selected' : ''" >(GMT-10:00) Hawaii</option>
                                                        <option timeZoneId="4" gmtAdjustment="GMT-09:00" useDaylightTime="1" value="4" :selected="oUser.timezone == '4' ? 'selected' : ''" >(GMT-09:00) Alaska</option>
                                                        <option timeZoneId="5" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="5" :selected="oUser.timezone == '5' ? 'selected' : ''" >(GMT-08:00) Pacific Time (US & Canada)</option>
                                                        <option timeZoneId="6" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="6" :selected="oUser.timezone == '6' ? 'selected' : ''" >(GMT-08:00) Tijuana, Baja California</option>
                                                        <option timeZoneId="7" gmtAdjustment="GMT-07:00" useDaylightTime="0" value="7" :selected="oUser.timezone == '7' ? 'selected' : ''" >(GMT-07:00) Arizona</option>
                                                        <option timeZoneId="8" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="8" :selected="oUser.timezone == '8' ? 'selected' : ''" >(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                        <option timeZoneId="9" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="9" :selected="oUser.timezone == '9' ? 'selected' : ''" >(GMT-07:00) Mountain Time (US & Canada)</option>
                                                        <option timeZoneId="10" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="10" :selected="oUser.timezone == '10' ? 'selected' : ''" >(GMT-06:00) Central America</option>
                                                        <option timeZoneId="11" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="11" :selected="oUser.timezone == '11' ? 'selected' : ''" >(GMT-06:00) Central Time (US & Canada)</option>
                                                        <option timeZoneId="12" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="12" :selected="oUser.timezone == '12' ? 'selected' : ''" >(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                        <option timeZoneId="13" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="13" :selected="oUser.timezone == '13' ? 'selected' : ''" >(GMT-06:00) Saskatchewan</option>
                                                        <option timeZoneId="14" gmtAdjustment="GMT-05:00" useDaylightTime="0" value="14" :selected="oUser.timezone == '14' ? 'selected' : ''" >(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                                        <option timeZoneId="15" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="15" :selected="oUser.timezone == '15' ? 'selected' : ''" >(GMT-05:00) Eastern Time (US & Canada)</option>
                                                        <option timeZoneId="16" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="16" :selected="oUser.timezone == '16' ? 'selected' : ''" >(GMT-05:00) Indiana (East)</option>
                                                        <option timeZoneId="17" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="17" :selected="oUser.timezone == '17' ? 'selected' : ''" >(GMT-04:00) Atlantic Time (Canada)</option>
                                                        <option timeZoneId="18" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="18" :selected="oUser.timezone == '18' ? 'selected' : ''" >(GMT-04:00) Caracas, La Paz</option>
                                                        <option timeZoneId="19" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="19" :selected="oUser.timezone == '19' ? 'selected' : ''" >(GMT-04:00) Manaus</option>
                                                        <option timeZoneId="20" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="20" :selected="oUser.timezone == '20' ? 'selected' : ''" >(GMT-04:00) Santiago</option>
                                                        <option timeZoneId="21" gmtAdjustment="GMT-03:30" useDaylightTime="1" value="21" :selected="oUser.timezone == '21' ? 'selected' : ''" >(GMT-03:30) Newfoundland</option>
                                                        <option timeZoneId="22" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="22" :selected="oUser.timezone == '22' ? 'selected' : ''" >(GMT-03:00) Brasilia</option>
                                                        <option timeZoneId="23" gmtAdjustment="GMT-03:00" useDaylightTime="0" value="23" :selected="oUser.timezone == '23' ? 'selected' : ''" >(GMT-03:00) Buenos Aires, Georgetown</option>
                                                        <option timeZoneId="24" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="24" :selected="oUser.timezone == '24' ? 'selected' : ''" >(GMT-03:00) Greenland</option>
                                                        <option timeZoneId="25" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="25" :selected="oUser.timezone == '25' ? 'selected' : ''" >(GMT-03:00) Montevideo</option>
                                                        <option timeZoneId="26" gmtAdjustment="GMT-02:00" useDaylightTime="1" value="26" :selected="oUser.timezone == '26' ? 'selected' : ''" >(GMT-02:00) Mid-Atlantic</option>
                                                        <option timeZoneId="27" gmtAdjustment="GMT-01:00" useDaylightTime="0" value="27" :selected="oUser.timezone == '27' ? 'selected' : ''" >(GMT-01:00) Cape Verde Is.</option>
                                                        <option timeZoneId="28" gmtAdjustment="GMT-01:00" useDaylightTime="1" value="28" :selected="oUser.timezone == '28' ? 'selected' : ''" >(GMT-01:00) Azores</option>
                                                        <option timeZoneId="29" gmtAdjustment="GMT+00:00" useDaylightTime="0" value="29" :selected="oUser.timezone == '29' ? 'selected' : ''" >(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                                        <option timeZoneId="30" gmtAdjustment="GMT+00:00" useDaylightTime="1" value="30" :selected="oUser.timezone == '30' ? 'selected' : ''" >(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                                                        <option timeZoneId="31" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="31" :selected="oUser.timezone == '31' ? 'selected' : ''" >(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                        <option timeZoneId="32" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="32" :selected="oUser.timezone == '32' ? 'selected' : ''" >(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                        <option timeZoneId="33" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="33" :selected="oUser.timezone == '33' ? 'selected' : ''" >(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                        <option timeZoneId="34" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="34" :selected="oUser.timezone == '34' ? 'selected' : ''" >(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                                        <option timeZoneId="35" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="35" :selected="oUser.timezone == '35' ? 'selected' : ''" >(GMT+01:00) West Central Africa</option>
                                                        <option timeZoneId="36" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="36" :selected="oUser.timezone == '36' ? 'selected' : ''" >(GMT+02:00) Amman</option>
                                                        <option timeZoneId="37" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="37" :selected="oUser.timezone == '37' ? 'selected' : ''" >(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                                        <option timeZoneId="38" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="38" :selected="oUser.timezone == '38' ? 'selected' : ''" >(GMT+02:00) Beirut</option>
                                                        <option timeZoneId="39" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="39" :selected="oUser.timezone == '39' ? 'selected' : ''" >(GMT+02:00) Cairo</option>
                                                        <option timeZoneId="40" gmtAdjustment="GMT+02:00" useDaylightTime="0" value="40" :selected="oUser.timezone == '40' ? 'selected' : ''" >(GMT+02:00) Harare, Pretoria</option>
                                                        <option timeZoneId="41" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="41" :selected="oUser.timezone == '41' ? 'selected' : ''" >(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                                        <option timeZoneId="42" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="42" :selected="oUser.timezone == '42' ? 'selected' : ''" >(GMT+02:00) Jerusalem</option>
                                                        <option timeZoneId="43" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="43" :selected="oUser.timezone == '43' ? 'selected' : ''" >(GMT+02:00) Minsk</option>
                                                        <option timeZoneId="44" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="44" :selected="oUser.timezone == '44' ? 'selected' : ''" >(GMT+02:00) Windhoek</option>
                                                        <option timeZoneId="45" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="45" :selected="oUser.timezone == '45' ? 'selected' : ''" >(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                                        <option timeZoneId="46" gmtAdjustment="GMT+03:00" useDaylightTime="1" value="46" :selected="oUser.timezone == '46' ? 'selected' : ''" >(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                        <option timeZoneId="47" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="47" :selected="oUser.timezone == '47' ? 'selected' : ''" >(GMT+03:00) Nairobi</option>
                                                        <option timeZoneId="48" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="48" :selected="oUser.timezone == '48' ? 'selected' : ''" >(GMT+03:00) Tbilisi</option>
                                                        <option timeZoneId="49" gmtAdjustment="GMT+03:30" useDaylightTime="1" value="49" :selected="oUser.timezone == '49' ? 'selected' : ''" >(GMT+03:30) Tehran</option>
                                                        <option timeZoneId="50" gmtAdjustment="GMT+04:00" useDaylightTime="0" value="50" :selected="oUser.timezone == '50' ? 'selected' : ''" >(GMT+04:00) Abu Dhabi, Muscat</option>
                                                        <option timeZoneId="51" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="51" :selected="oUser.timezone == '51' ? 'selected' : ''" >(GMT+04:00) Baku</option>
                                                        <option timeZoneId="52" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="52" :selected="oUser.timezone == '52' ? 'selected' : ''" >(GMT+04:00) Yerevan</option>
                                                        <option timeZoneId="53" gmtAdjustment="GMT+04:30" useDaylightTime="0" value="53" :selected="oUser.timezone == '53' ? 'selected' : ''" >(GMT+04:30) Kabul</option>
                                                        <option timeZoneId="54" gmtAdjustment="GMT+05:00" useDaylightTime="1" value="54" :selected="oUser.timezone == '54' ? 'selected' : ''" >(GMT+05:00) Yekaterinburg</option>
                                                        <option timeZoneId="55" gmtAdjustment="GMT+05:00" useDaylightTime="0" value="55" :selected="oUser.timezone == '55' ? 'selected' : ''" >(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                                        <option timeZoneId="56" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="56" :selected="oUser.timezone == '56' ? 'selected' : ''" >(GMT+05:30) Sri Jayawardenapura</option>
                                                        <option timeZoneId="57" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="57" :selected="oUser.timezone == '57' ? 'selected' : ''" >(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                        <option timeZoneId="58" gmtAdjustment="GMT+05:45" useDaylightTime="0" value="58" :selected="oUser.timezone == '58' ? 'selected' : ''" >(GMT+05:45) Kathmandu</option>
                                                        <option timeZoneId="59" gmtAdjustment="GMT+06:00" useDaylightTime="1" value="59" :selected="oUser.timezone == '59' ? 'selected' : ''" >(GMT+06:00) Almaty, Novosibirsk</option>
                                                        <option timeZoneId="60" gmtAdjustment="GMT+06:00" useDaylightTime="0" value="60" :selected="oUser.timezone == '60' ? 'selected' : ''" >(GMT+06:00) Astana, Dhaka</option>
                                                        <option timeZoneId="61" gmtAdjustment="GMT+06:30" useDaylightTime="0" value="61" :selected="oUser.timezone == '61' ? 'selected' : ''" >(GMT+06:30) Yangon (Rangoon)</option>
                                                        <option timeZoneId="62" gmtAdjustment="GMT+07:00" useDaylightTime="0" value="62" :selected="oUser.timezone == '62' ? 'selected' : ''" >(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                        <option timeZoneId="63" gmtAdjustment="GMT+07:00" useDaylightTime="1" value="63" :selected="oUser.timezone == '63' ? 'selected' : ''" >(GMT+07:00) Krasnoyarsk</option>
                                                        <option timeZoneId="64" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="64" :selected="oUser.timezone == '64' ? 'selected' : ''" >(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                        <option timeZoneId="65" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="65" :selected="oUser.timezone == '65' ? 'selected' : ''" >(GMT+08:00) Kuala Lumpur, Singapore</option>
                                                        <option timeZoneId="66" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="66" :selected="oUser.timezone == '66' ? 'selected' : ''" >(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                        <option timeZoneId="67" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="67" :selected="oUser.timezone == '67' ? 'selected' : ''" >(GMT+08:00) Perth</option>
                                                        <option timeZoneId="68" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="68" :selected="oUser.timezone == '68' ? 'selected' : ''" >(GMT+08:00) Taipei</option>
                                                        <option timeZoneId="69" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="69" :selected="oUser.timezone == '69' ? 'selected' : ''" >(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                        <option timeZoneId="70" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="70" :selected="oUser.timezone == '70' ? 'selected' : ''" >(GMT+09:00) Seoul</option>
                                                        <option timeZoneId="71" gmtAdjustment="GMT+09:00" useDaylightTime="1" value="71" :selected="oUser.timezone == '71' ? 'selected' : ''" >(GMT+09:00) Yakutsk</option>
                                                        <option timeZoneId="72" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="72" :selected="oUser.timezone == '72' ? 'selected' : ''" >(GMT+09:30) Adelaide</option>
                                                        <option timeZoneId="73" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="73" :selected="oUser.timezone == '73' ? 'selected' : ''" >(GMT+09:30) Darwin</option>
                                                        <option timeZoneId="74" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="74" :selected="oUser.timezone == '74' ? 'selected' : ''" >(GMT+10:00) Brisbane</option>
                                                        <option timeZoneId="75" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="75" :selected="oUser.timezone == '75' ? 'selected' : ''" >(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                                        <option timeZoneId="76" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="76" :selected="oUser.timezone == '76' ? 'selected' : ''" >(GMT+10:00) Hobart</option>
                                                        <option timeZoneId="77" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="77" :selected="oUser.timezone == '77' ? 'selected' : ''" >(GMT+10:00) Guam, Port Moresby</option>
                                                        <option timeZoneId="78" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="78" :selected="oUser.timezone == '78' ? 'selected' : ''" >(GMT+10:00) Vladivostok</option>
                                                        <option timeZoneId="79" gmtAdjustment="GMT+11:00" useDaylightTime="1" value="79" :selected="oUser.timezone == '79' ? 'selected' : ''" >(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                                        <option timeZoneId="80" gmtAdjustment="GMT+12:00" useDaylightTime="1" value="80" :selected="oUser.timezone == '80' ? 'selected' : ''" >(GMT+12:00) Auckland, Wellington</option>
                                                        <option timeZoneId="81" gmtAdjustment="GMT+12:00" useDaylightTime="0" value="81" :selected="oUser.timezone == '81' ? 'selected' : ''" >(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                        <option timeZoneId="82" gmtAdjustment="GMT+13:00" useDaylightTime="0" value="82" :selected="oUser.timezone == '82' ? 'selected' : ''" >(GMT+13:00) Nuku'alofa</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Date format</label>
                                                <div class="">
                                                    <select name="date_format" class="form-control">
                                                        <option>Select</option>
                                                        <option value="Y-M-d" :selected="oUser.date_format == 'Y-M-d' ? 'selected' : ''" >YYYY-MM-DD</option>
                                                        <option value="d-M-Y" :selected="oUser.date_format == 'd-M-Y' ? 'selected' : ''" >DD-MM-YYYY</option>
                                                        <option value="M-d-Y" :selected="oUser.date_format == 'M-d-Y' ? 'selected' : ''" >MM-DD-YYYY</option>
                                                        <option value="M d,Y" :selected="oUser.date_format == 'M d,Y' ? 'selected' : ''" >MM DD,YYYY</option>
                                                        <option value="d M,Y" :selected="oUser.date_format == 'd M,Y' ? 'selected' : ''" >DD MM,YYYY</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Time format</label>
                                                <div class="">
                                                    <select name="time_format" class="form-control">
                                                        <option>Select</option>
                                                        <option value="h:i" :selected="oUser.time_format == 'h:i' ? 'selected' : ''" >12H</option>
                                                        <option value="H:i" :selected="oUser.time_format == 'H:i' ? 'selected' : ''" >24H</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--====GENERAL SETTINGS====-->
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Working hours</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Start of the week</label>
                                                <div class="">
                                                    <select name="wh_start_week" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="monday" :selected="oUser.wh_start_week == 'monday' ?  'selected' : ''" >Monday</option>
                                                        <option value="tuesday" :selected="oUser.wh_start_week == 'tuesday' ?  'selected' : ''" >Tuesday</option>
                                                        <option value="wednesday" :selected="oUser.wh_start_week == 'wednesday' ? 'selected' : ''" >Wednesday</option>
                                                        <option value="thursday" :selected="oUser.wh_start_week == 'thursday' ?  'selected' : ''">Thursday</option>
                                                        <option value="friday" :selected="oUser.wh_start_week == 'friday' ?  'selected' : ''" >Friday</option>
                                                        <option value="saturday" :selected="oUser.wh_start_week == 'saturday' ?  'selected' : ''" >Saturday</option>
                                                        <option value="sunday" :selected="oUser.wh_start_week == 'sunday' ?  'selected' : ''" >Sunday</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Start of the working day</label>
                                                <div class="">
                                                    <select name="wh_start_day" class="form-control" style="width:48%; float:left;">
                                                        <option value="">Select Hours</option>
                                                        <option value="7am" :selected="oUser.wh_start_day == '7am' ? 'selected' : ''" >7 AM</option>
                                                        <option value="8am" :selected="oUser.wh_start_day == '8am' ? 'selected' : ''" >8 AM</option>
                                                        <option value="9am" :selected="oUser.wh_start_day == '9am' ? 'selected' : ''" >9 AM</option>
                                                        <option value="10am" :selected="oUser.wh_start_day == '10am' ? 'selected' : ''" >10 AM</option>
                                                        <option value="11am" :selected="oUser.wh_start_day == '11am' ? 'selected' : ''" >11 AM</option>
                                                    </select>

                                                    <select name="wh_start_day_minutes" class="form-control" style="width:48%; float:right;">
                                                        <option value="">Select Minutes</option>
                                                        <option value="00" :selected="oUser.wh_start_day_minutes == '00' ? 'selected' : ''" >00</option>
                                                        <option value="15" :selected="oUser.wh_start_day_minutes == '15' ? 'selected' : ''" >15</option>
                                                        <option value="30" :selected="oUser.wh_start_day_minutes == '30' ? 'selected' : ''" >30</option>
                                                        <option value="45" :selected="oUser.wh_start_day_minutes == '45' ? 'selected' : ''" >45</option>
                                                    </select>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">End of the working day</label>
                                                <div class="">
                                                    <select name="wh_end_day" class="form-control" style="width:48%; float:left;">
                                                        <option value="">Select Hours</option>
                                                        <option value="4pm" :selected="oUser.wh_end_day == '4pm' ? 'selected' : ''" >4 PM</option>
                                                        <option value="5pm" :selected="oUser.wh_end_day == '5pm' ? 'selected' : ''" >5 PM</option>
                                                        <option value="6pm" :selected="oUser.wh_end_day == '6pm' ? 'selected' : ''" >6 PM</option>
                                                        <option value="7pm" :selected="oUser.wh_end_day == '7pm' ? 'selected' : ''" >7 PM</option>
                                                        <option value="8pm" :selected="oUser.wh_end_day == '8pm' ? 'selected' : ''" >8 PM</option>
                                                    </select>
                                                    <select name="wh_end_day_minutes" class="form-control" style="width:48%; float:right;">
                                                        <option value="">Select Minutes</option>
                                                        <option value="00" :selected="oUser.wh_end_day_minutes == '00' ? 'selected' : ''" >00</option>
                                                        <option value="15" :selected="oUser.wh_end_day_minutes == '15' ? 'selected' : ''" >15</option>
                                                        <option value="30" :selected="oUser.wh_end_day_minutes == '30' ? 'selected' : ''" >30</option>
                                                        <option value="45" :selected="oUser.wh_end_day_minutes == '45' ? 'selected' : ''" >45</option>
                                                    </select>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--====SAVE====-->
                                <div class="p30">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn dark_btn ml20 bkg_purple" ><span>Save</span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading">
                            <h4 class="panel-title">Fields</h4>
                        </div>
                        <form id="frmGeneralBusinessInfo4" name="frmGeneralBusinessInfo4" method="post">
                            <div class="panel-body p0">
                                <!--====GENERAL SETTINGS====-->
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Fields settings</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">We call people who leave reviews</label>
                                                <div class="">
                                                    <select name="reviewer_alias" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="customer" :selected="oUser.reviewer_alias == 'customer' ? 'selected' : ''" >Customer</option>
                                                        <option value="client" :selected="oUser.reviewer_alias == 'client' ? 'selected' : ''" >Client</option>
                                                        <option value="buyer" :selected="oUser.reviewer_alias == 'buyer' ? 'selected' : ''" >Buyer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">We call people who sell to us</label>
                                                <div class="">
                                                    <select name="seller_alias" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="seller" :selected="oUser.seller_alias == 'seller' ? 'selected' : ''" >Seller</option>
                                                        <option value="partner" :selected="oUser.seller_alias == 'partner' ? 'selected' : ''" >Partner</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">We call reviews</label>
                                                <div class="">
                                                    <select name="review_alias" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="review" :selected="oUser.review_alias == 'review' ? 'selected' : ''" >Reviews</option>
                                                        <option value="feedback" :selected="oUser.review_alias == 'feedback' ? 'selected' : ''" >Feedback</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--====SAVE====-->
                                <div class="p30">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" id="settingsUserId" :value="oUser.id" />
                                            <button type="submit" class="btn dark_btn ml20 bkg_purple" ><span>Save</span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading" style="padding: 10px;">
                            <h4 class="panel-title">Help Card</h4>
                        </div>
                        <div class="panel-body min_h405 p40 pt60 info_card text-center">
                            <div class="img_icon mb20"><img src="/assets/images/icon_cog.png" width="35"></div>
                            <p class="mb20"><strong>Learn more about how to<br> configurate your brand<br> account</strong></p>
                            <p class="mb20"><span>Being the savage's bowsman, that <br>is, the person who pulled.</span></p>
                            <a class="txt_purple" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="seletedTab === 3" class="tab-pane " id="right-icon-tab1">
            <div class="clearfix">&nbsp;</div>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading" style="padding: 10px;">
                            <h6 class="panel-title">Subscription</h6>
                        </div>
                        <div class="panel-body p0">

                            <!--====GENERAL SETTINGS====-->
                            <div class="bbot p30">
                                <div class="row" style="margin-bottom:60px !important;">
                                    <div class="col-md-9 col-xs-9">
                                        <p class="m0"><strong class="fsize16">Account Plans</strong><br>
                                            <span class="text-muted fsize13">Pick an account plan that fits your workflow. Add a credits<br>
                                        plan to any project when it's ready to go live.</span>
                                        </p>
                                    </div>
                                    <div class="col-md-3 col-xs-3">
                                        <p class="pull-left text-muted fsize13 mr-20">Billing Type:</p>
                                        <div class="btn-group display-inline-block">
                                            <button id="grid" type="button" class="btn btn-xs btn-default dispUpgradePlan" data-cycle="yearly">Annual</button>
                                            <button id="list" type="button" class="btn btn-xs btn-default dispUpgradePlan" data-cycle="monthly">Monthly</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <!--@include('admin.modals.upgrade.partial.plan_list')-->
                                <div class="row monthly_pricing_plan" v-if="(oCurrentPlanData != '' && (oCurrentPlanData.subs_cycle != 'month' || oCurrentPlanData.subs_cycle != 'monthly') && oCurrentPlanData.level_name != 'Pro')">
                                    <!-- Pricing -->
                                    <div v-if="((oMembership.type == 'membership') && (oMembership.subs_cycle == 'monthly' || oMembership.subs_cycle == 'month'))" v-for="oMembership in oMemberships" class="col-xs-4">
                                        <div class="price_plan">
                                            <div class="imgicon">
                                                <img v-if="oMembership.level_name == 'Starter'" src="/assets/images/starter_icon.png"/>
                                                <img v-else-if="oMembership.level_name == 'Business'" src="/assets/images/business_icon.png"/>
                                                <img v-else-if="oMembership.level_name == 'Pro'" src="/assets/images/pro_icon.png"/>
                                                <img v-else src="/assets/images/pro_icon.png"/>
                                            </div>
                                            <div class="bbot p30 text-center">
                                                <p class="txt_purple fsize16 mt-5">{{ oMembership.level_name }}</p>
                                                <h3 class="mt-5 mb0">${{ oMembership.price }}<span>/mo</span></h3>
                                                <p class="text-muted fsize13 m0">Billed Monthly</p>
                                            </div>

                                            <div class="bbot p20 text-center">
                                                <p class="text-muted fsize12 m0">A light plan that lets you export your<br> code for use in other environments<br> or build prototypes.</p>
                                            </div>
                                            <div class="p30 pt20 pb20">
                                                <ul class="mb20">
                                                    <li><i class="icon-checkmark-circle"></i> {{ number_format(oMembership.credits) }} Credits</li>
                                                    <li><i class="icon-checkmark-circle"></i> {{ number_format(oMembership.contact_limit) }} Contacts</li>
                                                    <li><i class="icon-checkmark-circle"></i> Reviews App</li>
                                                    <li><i class="icon-checkmark-circle"></i> Chat App</li>
                                                    <li v-if="(oMembership.level_name != 'Pro' && oMembership.level_name != 'Business')" class="disabled" >
                                                        <i v-if="(oMembership.level_name != 'Pro' && oMembership.level_name != 'Business')" class="icon-cancel-circle2"></i>
                                                        <i v-else class="icon-checkmark-circle"></i>
                                                        On Site widgets
                                                    </li>
                                                    <li v-if="(oMembership.level_name != 'Pro' && oMembership.level_name != 'Business')" class="disabled">
                                                        <i v-if="(oMembership.level_name != 'Pro' && oMembership.level_name != 'Business')" class="icon-cancel-circle2"></i>
                                                        <i v-else class="icon-checkmark-circle"></i>
                                                        Automation/Broadcast App
                                                    </li>
                                                    <li v-if="(oMembership.level_name != 'Pro')" class="disabled">
                                                        <i v-if="(oMembership.level_name != 'Pro')" class="icon-cancel-circle2"></i>
                                                        <i v-else class="icon-checkmark-circle"></i>
                                                        NPS App
                                                    </li>
                                                    <li v-if="(oMembership.level_name != 'Pro')" class="disabled">
                                                        <i v-if="(oMembership.level_name != 'Pro')" class="icon-cancel-circle2"></i>
                                                        <i v-else class="icon-checkmark-circle"></i>
                                                        Referral App
                                                    </li>
                                                    <li v-if="(oMembership.level_name != 'Pro')" class="disabled">
                                                        <i v-if="(oMembership.level_name != 'Pro')" class="icon-cancel-circle2"></i>
                                                        <i v-else class="icon-checkmark-circle"></i>
                                                        Analytics
                                                    </li>
                                                </ul>

                                                <button v-if="oMembership.isMembershipActive" type="button" class="btn white_btn w100 h40 txt_purple"><span>Active</span> </button>

                                                <button v-else type="button" class="btn dark_btn w100 bkg_purple h40 confirmManualUpgrade" :plan_id="oMembership.plan_id" :plan_name="oMembership.level_name">
                                                    <span v-if="oCurrentPlanData == ''">Buy</span>
                                                    <span v-else-if="oMembership.isMembershipActive != ''">Upgrade</span>
                                                    <span v-else>Downgrade</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--//End Pricing -->
                                </div>

                                <div class="row yearly_pricing_plan" v-if="(!((oCurrentPlanData.subs_cycle == 'yearly' || oCurrentPlanData.subs_cycle == 'year') || (oCurrentPlanData.level_name == 'Pro')))">
                                    <!-- Pricing -->
                                    <div v-for="oMembership in oMemberships" class="col-xs-4" v-if="((oMembership.type == 'membership') && (oMembership.subs_cycle == 'yearly' || oMembership.subs_cycle == 'year'))">
                                        <div class="price_plan">
                                            <div class="imgicon">
                                                <img v-if="oMembership.level_name == 'Starter Yearly'" src="/assets/images/starter_icon.png"/>
                                                <img v-if="oMembership.level_name == 'Business Yearly'" src="/assets/images/business_icon.png"/>
                                                <img v-if="oMembership.level_name == 'Pro Yearly'" src="/assets/images/pro_icon.png"/>
                                                <img v-else src="/assets/images/pro_icon.png"/>
                                            </div>
                                            <div class="bbot p30 text-center">
                                                <p class="txt_purple fsize16 mt-5">{{ oMembership.level_name }}</p>
                                                <h3 class="mt-5 mb0">${{ oMembership.price }}<span>/yr</span></h3>
                                                <p class="text-muted fsize13 m0">Billed Yearly</p>
                                            </div>

                                            <div class="bbot p20 text-center">
                                                <p class="text-muted fsize12 m0">A light plan that lets you export your<br> code for use in other environments<br> or build prototypes.</p>
                                            </div>
                                            <div class="p30 pt20 pb20">
                                                <ul class="mb20">
                                                    <li><i class="icon-checkmark-circle"></i> {{ number_format(oMembership.credits) }} Credits</li>
                                                    <li><i class="icon-checkmark-circle"></i> {{ number_format(oMembership.contact_limit) }} Contacts</li>
                                                    <li><i class="icon-checkmark-circle"></i> Reviews App</li>
                                                    <li><i class="icon-checkmark-circle"></i> Chat App</li>
                                                    <li v-if="(oMembership.level_name != 'Pro Yearly' && oMembership.level_name != 'Business Yearly')" class="disabled">
                                                        <i v-if="(oMembership.level_name != 'Pro Yearly' && oMembership.level_name != 'Business Yearly')" class="icon-cancel-circle2"></i>
                                                        <i v-else class="icon-checkmark-circle"></i>
                                                        On Site widgets
                                                    </li>
                                                    <li v-if="(oMembership.level_name != 'Pro Yearly' && oMembership.level_name != 'Business Yearly')" class="disabled">
                                                        <i v-if="(oMembership.level_name != 'Pro Yearly' && oMembership.level_name != 'Business Yearly')" class="icon-cancel-circle2"></i>
                                                        <i v-else class="icon-checkmark-circle"></i>
                                                        Automation/Broadcast App
                                                    </li>
                                                    <li v-if="(oMembership.level_name != 'Pro Yearly')" class="disabled" >
                                                        <i v-if="(oMembership.level_name != 'Pro Yearly')" class="icon-cancel-circle2"></i>
                                                        <i class="icon-checkmark-circle"></i>
                                                        NPS App
                                                    </li>
                                                    <li v-if="(oMembership.level_name != 'Pro Yearly')" class="disabled">
                                                        <i v-if="(oMembership.level_name != 'Pro Yearly')" class="icon-cancel-circle2"></i>
                                                        <i v-else class="icon-checkmark-circle"></i>
                                                        Referral App
                                                    </li>
                                                    <li v-if="(oMembership.level_name != 'Pro Yearly')" class="disabled">
                                                        <i v-if="(oMembership.level_name != 'Pro Yearly')" class="icon-cancel-circle2"></i>
                                                        <i v-else class="icon-checkmark-circle"></i>
                                                        Analytics
                                                    </li>
                                                </ul>

                                                <button v-if="oMembership.isMembershipActive" type="button" class="btn white_btn w100 txt_purple h40"><span>Active</span> </button>

                                                <button v-else type="button" class="btn dark_btn w100 bkg_purple h40 confirmManualUpgrade" :plan_id="oMembership.plan_id" :plan_name="oMembership.level_name">
                                                    <span v-if="(oMembership.isMembershipActive != '' && oCurrentPlanData.level_name == 'Pro')">Upgrade</span>
                                                    <span v-else>Downgrade</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--//End Pricing -->
                                </div>

                            </div>

                            <div class="p30">
                                <div class="row">
                                    <div class="col-md-9 col-xs-9"><p class="m0">All plans come with basic Brand Boost features</p></div>
                                    <div class="col-md-3 col-xs-3"><a class="txt_purple" href="#">Explore all features</a></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading" style="padding: 10px;">
                            <h6 class="panel-title">Brand Boost Credits</h6>
                        </div>
                        <div class="panel-body p0">


                            <!--====GENERAL SETTINGS====-->
                            <div class="bbot p30">
                                <div class="row mb40">
                                    <div class="col-xs-9">
                                        <p class="m0"><strong class="fsize16">Credits Plans</strong><br>
                                            <span class="text-muted fsize13">All projects on your plan come with Staging. Upgrade to a paid credit<br>
                                        plan to send emails & SMS and unlock other features.</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div v-if="oMemberships != ''" class="row mt40">
                                    <div v-if="oMembership.type == 'topup-membership'" v-for="oMembership in oMemberships" class="col-xs-4" style="margin-top:20px;">
                                        <div class="price_plan">
                                            <div class="imgicon"><img src="/assets/images/icon_credit.png"/></div>
                                            <div class="bbot p30 text-center">
                                                <p class="txt_purple fsize16">{{ number_format(oMembership.credits) }} credits</p>
                                                <h3>${{ oMembership.price }}
                                                    <span v-if="oMembership.subs_cycle == 'week'"> /week</span>
                                                    <span v-else-if="oMembership.subs_cycle == 'month'"> /Mo</span>
                                                    <span v-else="oMembership.subs_cycle == 'year'"> /Yr</span>
                                                </h3>
                                                <p class="text-muted fsize13 m0">Billed
                                                    <span v-if="oMembership.subs_cycle == 'week'"> Weekly</span>
                                                    <span v-else-if="oMembership.subs_cycle == 'month'"> Monthly</span>
                                                    <span v-else="oMembership.subs_cycle == 'year'"> Yearly</span>
                                                </p>
                                            </div>

                                            <div class="p30">
                                                <button v-if="(oUser.topup_plan_id == oMembership.plan_id)" type="button" class="btn white_btn w100 h40 txt_purple"><span>Active</span> </button>
                                                <button v-else type="button" class="btn dark_btn w100 bkg_purple h40 confirmTopupUpgrade" :topup_plan_name="oMembership.level_name" :topup_plan_id="oMembership.plan_id" data-toggle="modal" data-target="#confirm_topup_level_upgrade">
                                                    <span v-if="oMembership.isTopupMembershipActive == ''">Buy</span>
                                                    <span v-if="oMembership.isTopupMembershipActive == 'true'">Upgrade</span>
                                                    <span v-else>Downgrade</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading" style="padding: 10px;">
                            <h6 class="panel-title">Addon Credits</h6>
                        </div>
                        <div class="panel-body p0">

                            <!--====GENERAL SETTINGS====-->
                            <div class="bbot p30">
                                <div class="row mb40">
                                    <div class="col-xs-9">
                                        <p class="m0"><strong class="fsize16">Addon Credits Pack</strong><br>
                                            <span class="text-muted fsize13">All projects on your plan come with Staging. Upgrade to a paid credit<br>
                                        plan to send emails & SMS and unlock other features.</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>


                                <div v-if="oMemberships != ''" class="row mt40">
                                    <div v-for="oMembership in oMemberships" v-if="(oMembership.type == 'topup' && oMembership.level_name != 'Custom Pack')" class="col-xs-4" style="margin-top:20px;">
                                        <div class="price_plan">
                                            <div class="imgicon"><img src="/assets/images/icon_credit.png"/></div>
                                            <div class="bbot p30 text-center">
                                                <p><strong>{{ oMembership.level_name }}</strong></p>
                                                <p class="txt_purple fsize16">{{ number_format(oMembership.credits) }} credits</p>
                                                <h3>${{ oMembership.price }}<span></span></h3>
                                                <p class="text-muted fsize13 m0">Flat Fee</p>
                                            </div>

                                            <div class="p30">
                                                <button type="button" class="btn dark_btn w100 bkg_purple h40 confirmBuyAddon" :topup_plan_name="oMembership.level_name" :topup_plan_id="oMembership.plan_id" :topup_plan_price="oMembership.price" data-toggle="modal" data-target="#confirm_buy_addon_plan"><span>Buy</span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="oMemberships != ''">
                            <div v-for="oMembership in oMemberships" v-if="(oMembership.type == 'topup' && oMembership.level_name == 'Custom Pack')" class="p30">
                                <div class="row">
                                    <div class="col-md-9 col-xs-9">
                                        <p class="m0"><strong class="fsize16">Buy Additional Brand Boost Credits</strong><br>
                                            <span class="text-muted fsize13">All projects on your plan come with Staging. </span>
                                        </p>
                                    </div>

                                    <div class="col-md-2 col-xs-2">
                                        <p class="fsize13">Credits</p>
                                        <div class="input-group input-group-xlg pull-right">
                                            <input class="form-control" value="1000" name="txtCustomQty"id="txtCustomQty" type="text" title="Enter quantity of credits" placeholder="1000">
                                            <span class="input-group-addon" id="customprice">${{ (oMembership.price * 1000) }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-1 col-xs-1">
                                        <p class="fsize13">&nbsp;</p>
                                        <button type="button" class="btn dark_btn w100 bkg_purple h40 confirmBuyCustomAddon" :topup_plan_name="oMembership.level_name" :topup_plan_id="oMembership.plan_id" :topup_plan_price="oMembership.price" data-toggle="modal" data-target="#confirm_buy_custom_addon_plan"><span>Buy</span> </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading" style="padding: 10px;">
                            <h6 class="panel-title">Info Card</h6>
                        </div>
                        <div class="panel-body min_h405 p40 pt60 info_card text-center">
                            <div class="img_icon mb20"><img src="/assets/images/icon_credit.png" width="35"></div>
                            <p class="mb20"><strong>Learn more about Brand Boost Credits</strong></p>
                            <p class="mb20"><span>Being the savage's bowsman, that <br>is, the person who pulled.</span></p>
                            <a class="txt_purple" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="seletedTab === 4" class="tab-pane " id="right-icon-tab1">
            Billing TAB HERE
        </div>

        <div v-if="seletedTab === 5" class="tab-pane " id="right-icon-tab1">
            Notifications TAB HERE
        </div>

        <div v-if="seletedTab === 6" class="tab-pane " id="right-icon-tab1">
            Import TAB HERE
        </div>

        <div v-if="seletedTab === 7" class="tab-pane " id="right-icon-tab1">
            Export TAB HERE
        </div>

        <!--******************
          Content Area
         **********************-->

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Admin Settings - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {


                loading: true,
                breadcrumb: '',
                settingsData: '',
                notificationData: '',
                oImportHistory: '',
                oExportHistory: '',
                oMemberships: '',
                oCurrentPlanData: '',
                oCurrentTopupPlanData: '',
                seletedTab: 1,
                oInvoices: '',
                notificationlisting: '',
                oUser: '',
                countries: ''
            }
        },
        mounted() {
            this.loadData();
            setTimeout(function(){
                loadJQCode();
            },2000);
        },
        methods: {
            loadData: function () {
                //getData
                axios.get('/admin/settings')
                    .then(response => {
                        //console.log(response.data);
                        this.showLoading(false);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.settingsData = response.data.settingsData;
                        this.notificationData = response.data.notificationData;
                        this.oImportHistory = response.data.oImportHistory;
                        this.oExportHistory = response.data.oExportHistory;
                        this.oMemberships = response.data.oMemberships;
                        this.oCurrentPlanData = response.data.oCurrentPlanData;
                        this.oCurrentTopupPlanData = response.data.oCurrentTopupPlanData;
                        this.seletedTab = response.data.seletedTab;
                        this.oInvoices = response.data.oInvoices;
                        this.notificationlisting = response.data.notificationlisting;
                        this.oUser = response.data.oUser;
                        this.countries = response.data.countries;
                    });
            }
        }
    }

    function loadJQCode(){
        $(document).ready(function () {
            $(".token-field").on('tokenfield:createdtoken tokenfield:removedtoken change', function (e) {
                if($(this).parent().children().hasClass('token')) {
                    $(this).parent().find('.token-input').attr('placeholder', '');
                }
                else {
                    $(this).parent().find('.token-input').attr('placeholder', '- Tokenfield');
                }
            }).trigger('change');

            $('.showSubPage').click(function(){
                $('.nav-tabs a[href="#right-icon-tab2"]').tab('show');
            });


            $('.changeBA1').click(function(){
                $('.changeBA1').removeClass('txt_purple');
                $(this).addClass('txt_purple');
            });

            $('.changeBA2').click(function(){
                $('.changeBA2').removeClass('txt_purple');
                $(this).addClass('txt_purple');
            });

            $('#public_publish_page').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="public_publish_page"]').attr("value", 1);
                } else {
                    $('input[name="public_publish_page"]').attr("value", 0);
                }
            });

            $('#business_address_dppa').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="business_address_dppa"]').attr("value", 1);
                } else {
                    $('input[name="business_address_dppa"]').attr("value", 0);
                }
            });

            $('#phone_no_dppa').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="phone_no_dppa"]').attr("value", 1);
                } else {
                    $('input[name="phone_no_dppa"]').attr("value", 0);
                }
            });

            $('#website_dppa').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="website_dppa"]').attr("value", 1);
                } else {
                    $('input[name="website_dppa"]').attr("value", 0);
                }
            });


            Dropzone.autoDiscover = false;
            var settingUserId = $("#settingsUserId").val();
            var myDropzone = new Dropzone(
                '#myDropzone', //id of drop zone element 1
                {
                    url: '/webchat/dropzone/upload_s3_attachment/'+settingUserId+'/onsite',
                    uploadMultiple: false,
                    maxFiles: 1,
                    maxFilesize: 600,
                    acceptedFiles: 'image/*',
                    addRemoveLinks: false,
                    success: function (response) {

                        if(response.xhr.responseText != "") {

                            $('#brand_logo_image_preview').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
                            var dropImage = $('#company_logo').val();
                            $.ajax({
                                url: 'admin/brandboost/deleteObjectFromS3',
                                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                                type: "POST",
                                data: {dropImage: dropImage},
                                dataType: "json",
                                success: function (data) {
                                    console.log(data);
                                }
                            });

                            $('#company_logo').val(response.xhr.responseText);
                            $('.saveUserOtherInfo').trigger('click');
                        }
                    }
                });

            myDropzone.on("complete", function(file) {
                myDropzone.removeFile(file);
            });
        });

    }



</script>
<style scoped>
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus { font-weight: bold; color: #000; }
    .price_plan { padding: 55px; margin: 10px!important; }
</style>
