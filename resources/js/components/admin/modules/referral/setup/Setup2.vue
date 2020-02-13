<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{campaign.title}} </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20"
                                v-if="this.campaign.status !='archive'" @click="saveDraft"> Save as draft
                        </button>
                        <button class="btn btn-md bkg_email_300 light_000" @click="displayStep(2)"> Next <span
                            style="opacity: 1"><img
                            src="/assets/images/arrow-right-line-white.svg"/></span></button>
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
                                <li><a class="" href="javascript:void(0);" @click="displayStep(1)"><span
                                    class="num_circle"><span class="num">1</span><span
                                    class="check_img"><img
                                    src="/assets/images/email_check.svg"/></span></span>Sources</a></li>
                                <li><a class="active" href="javascript:void(0);"><span class="num_circle"><span
                                    class="num">2</span><span
                                    class="check_img"><img
                                    src="/assets/images/email_check.svg"/></span></span>Rewards</a></li>
                                <li><a href="javascript:void(0);" @click="displayStep(3)"><span class="num_circle"><span
                                    class="num">3</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Workflow</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(4)"><span class="num_circle"><span
                                    class="num">4</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Configuration</a>
                                </li>
                                <li><a href="javascript:void(0);" @click="displayStep(5)"><span class="num_circle"><span
                                    class="num">5</span><span
                                    class="check_img"><img src="/assets/images/email_check.svg"/></span></span>Integration</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#advocateTabSetup"><strong>Advocates
                            Reward</strong></a></li>
                        <li><a data-toggle="tab" href="#friendTabSetup"><strong>Friends Reward</strong></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="advocateTabSetup" class="select_section tab-pane fade in active show mt-10 mb-10">
                            <div class="row mb30">
                                <div class="col-md-4 text-center">
                                    <label for="temp1" class="m0 w-100">
                                        <div class="broadcast_select_contact ref">
                                            <label class="custmo_checkbox">
                                                <input class="check" type="radio" id="temp1" v-model="advocateGiftType" value="coupon" name="advocateGiftType" :checked="settings.adv_coupon_id>0" @change="">
                                                <span class="custmo_checkmark green_tr"></span>
                                            </label>
                                            <div class="img_box img_active" v-if="settings.adv_coupon_id>0  || advocateGiftType == 'coupon'"> <img src="http://brandboost.io/assets/images/ref_reward_1_act.png"> </div>
                                            <div class="img_box img_inactive" v-else> <img src="http://brandboost.io/assets/images/ref_reward_1.png"> </div>

                                            <p class="fsize14 txt_dark fw500">Coupon</p>
                                            <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label for="temp2" class="m0 w-100">
                                        <div class="broadcast_select_contact ref">
                                            <label class="custmo_checkbox">
                                                <input class="check" type="radio" :checked="settings.cast_id>0" id="temp2" value="cash" v-model="advocateGiftType" name="advocateGiftType">
                                                <span class="custmo_checkmark green_tr"></span>
                                            </label>
                                            <div class="img_box img_active" v-if="settings.cash_id>0  || advocateGiftType == 'cash'"> <img src="http://brandboost.io/assets/images/ref_reward_2_act.png"></div>
                                            <div class="img_box img_inactive" v-else> <img src="http://brandboost.io/assets/images/ref_reward_2.png"> </div>
                                            <p class="fsize14 txt_dark fw500">Cash</p>
                                            <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label for="temp3" class="m0 w-100">
                                        <div class="broadcast_select_contact ref">
                                            <label class="custmo_checkbox">
                                                <input class="check" type="radio" id="temp3" name="advocateGiftType" value="custom" v-model="advocateGiftType" :checked="settings.custom_id>0" >
                                                <span class="custmo_checkmark green_tr"></span> </label>
                                            <div class="img_box img_active" v-if="settings.custom_id>0 || advocateGiftType == 'custom'"> <img src="http://brandboost.io/assets/images/ref_reward_3_act.png"> </div>
                                            <div class="img_box img_inactive" v-else> <img src="http://brandboost.io/assets/images/ref_reward_3.png"> </div>
                                            <p class="fsize14 txt_dark fw500">Custom</p>
                                            <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card p40 min_h_240">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="htxt_bold_16 dark_700 mb10">Gift Configuration</h3>
                                                <p class="fsize12 fw300 dark_300 mb20">This text will be displayed in the ‘Subject’ field in your recepient’s email client.</p>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Amount</label>
                                                    <div class="">
                                                        <input type="hidden" name="rewardType" value="advocate_discount">
                                                        <input name="advocate_discount_price" class="form-control" type="text" value="12" required="" placeholder="10">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">&nbsp;</label>
                                                    <div class="">
                                                        <!--<div class="input-group">
                                                                      <input type="hidden" name="advocate_discount_type" class="form-control advocate_discount_type" value="percent" placeholder="%">
                                                                      <input type="text" name="" value="%" id="adCouponVal" class="form-control" readonly="">
                                                                      <span style="display: none;" class="input-group-addon bkg_dgreen bor_n adCouponType" amtsign="%" amttext="percent"><i class="icon-percent txt_white"></i></span>
                                                                      <span style="display: table-cell;" class="input-group-addon bkg_dgreen bor_n adCouponType" amtsign="$" amttext="dollar"><i class="icon-coin-dollar txt_white"></i></span>
                                                                  </div>-->
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="%" id="demo" name="email">
                                                            <div class="input-group-append"> <span class="input-group-text">$</span> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="control-label">Reward Message</label>
                                                    <div class="">
                                                        <input type="text" name="advocate_discount" class="form-control" value="12% off" placeholder="e.g. 20% off" required="required">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border p20 bkg_light_050 shadow-none mt30 mb0">
                                            <div class="radio">
                                                <label> <span class="float-left" style="margin: 2px 8px 0 0">
                    <input type="radio" name="advCouponCode" option-type="adv_single_use_coupons" class="control-primary advocate_options">
                    </span> <strong>Single Use Coupons</strong> Unique coupon codes for every advocate </label>
                                            </div>
                                            <div class="coupon_desc p20" id="advocate-single-use_code" style="display: block;">
                                                <form name="frmAdvSingleUseCodes" id="frmAdvSingleUseCodes" data-container-id="advocate-coupon-details" method="post">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <label class="control-label">Paste your coupon codes here</label>
                                                                <div class="">
                                                                    <textarea name="singleCouponCodes" class="form-control fsize13 p20" placeholder="list of coupon codes" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <div class="form-group">
                                                                <label class="control-label">&nbsp;</label>
                                                                <div>
                                                                    <input type="hidden" name="couponType" value="advocate_single_coupons">
                                                                    <input type="hidden" name="rewardID" value="25">
                                                                    <button type="submit" class="btn btn-md bkg_email_300 light_000 pl20 pr20 singleCouponCodesSubmit">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="radio">
                                                <label> <span class="float-left" style="margin: 2px 8px 0 0">
                    <input type="radio" name="advCouponCode" option-type="adv_multiple_use_coupons" checked="checked" class="control-primary advocate_options">
                    </span> <strong>Multiple Use Coupons</strong> Reusable coupon code for all advocates </label>
                                            </div>
                                            <div class="coupon_desc p20" id="advocate-multiple-use_code" style="display: block;">
                                                <form name="frmAdvMultipleUseCodes" id="frmAdvMultipleUseCodes" data-container-id="advocate-coupon-details" method="post">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Paste your coupon code</label>
                                                                <div class="">
                                                                    <input type="text" class="form-control" name="multipleCouponCodes" value="Test1" id="multipleCouponCodes" placeholder="e.g. REWARD10">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Expiry</label>
                                                                <div class="">
                                                                    <select class="form-control" id="adv_coupon_expiry" name="coupon_expiry">
                                                                        <option value="never">Never(Recommended)</option>
                                                                        <option value="6" selected="selected">6 Months</option>
                                                                        <option value="5">5 Months</option>
                                                                        <option value="4">4 Months</option>
                                                                        <option value="3">3 Months</option>
                                                                        <option value="2">2 Months</option>
                                                                        <option value="1">1 Months</option>
                                                                        <option value="specific-date">Specific Date</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label">&nbsp;</label>
                                                                <div class="">
                                                                    <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="adv_specific_expiry_picker" value="" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <div class="form-group">
                                                                <label class="control-label">&nbsp;</label>
                                                                <div>
                                                                    <input type="hidden" name="couponType" value="advocate_multiple_coupons">
                                                                    <input type="hidden" name="rewardID" value="25">
                                                                    <button type="submit" class="btn btn-md bkg_email_300 light_000 pl20 pr20  multipalCouponCodesSubmit"><span>Save Changes</span> </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt20" style="display:none;">
                                <div class="col-md-12">
                                    <div class="white_box p20 pl30 pr30">
                                        <div class="row advocateGiftHeading">
                                            <div class="col-md-12 mb20">
                                                <p class="fsize15 bbot pb-15">Gift Configuration</p>
                                            </div>
                                        </div>

                                        <div class="p20 advocateGiftD">
                                            <div class="row">

                                                <div class="advocate_desc" id="advocate-discount-new"
                                                     v-show="settings.adv_coupon_id>0">
                                                    <form name="frmAdvocateDiscount" id="frmAdvocateDiscount"
                                                          method="post" data-container-id="advocate-free-gift">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Amount</label>
                                                                <div class="">
                                                                    <input type="hidden" name="rewardType"
                                                                           value="advocate_discount"/>
                                                                    <input name="advocate_discount_price"
                                                                           class="form-control" type="text"
                                                                           :value="settings.advocate_discount" required
                                                                           placeholder="10">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label class="control-label">&nbsp;</label>
                                                                <div class="">
                                                                    <div class="input-group">
                                                                        <input type="hidden"
                                                                               name="advocate_discount_type"
                                                                               class="form-control advocate_discount_type"
                                                                               :value="settings.advocate_discount_type ? settings.advocate_discount_type : 'percent'"
                                                                               placeholder="%">
                                                                        <input type="text" name=""
                                                                               :value="advocateGiftProps('advocate_discount_type').unit"
                                                                               id="adCouponVal" class="form-control"
                                                                               readonly/>
                                                                        <span
                                                                            :style="`display: ${advocateGiftProps('advocate_discount_type').dollar}`"
                                                                            class="input-group-addon bkg_dgreen bor_n adCouponType"
                                                                            amtSign="%" amtText="percent"><i
                                                                            class="icon-percent txt_white"></i></span>
                                                                        <span
                                                                            :style="`display: ${advocateGiftProps('advocate_discount_type').percent}`"
                                                                            class="input-group-addon bkg_dgreen bor_n adCouponType"
                                                                            amtSign="$" amtText="dollar"><i
                                                                            class="icon-coin-dollar txt_white"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label">Reward Message</label>
                                                                <div class="">
                                                                    <input type="text" name="advocate_discount"
                                                                           class="form-control"
                                                                           :value="settings.advocate_display_msg ? settings.advocate_display_msg : '20% off'"
                                                                           placeholder="e.g. 20% off"
                                                                           required="required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 text-right hidden">
                                                            <div class="form-group">
                                                                <label class="control-label">&nbsp;</label>
                                                                <div>

                                                                    <input type="hidden" name="rewardID"
                                                                           :value="settings.rewardID"/>
                                                                    <button type="button" class="btn white_btn"><span>Cancel</span>
                                                                    </button>
                                                                    <button type="submit"
                                                                            class="btn dark_btn ml20 bkg_dgreen advDiscountSave">
                                                                        <span>Save Changes</span></button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- *--- start ---* -->
                                                    <div class="clearfix"></div>
                                                    <div class="panel-body" style="box-shadow: none;">


                                                        <div class="radio">
                                                            <label>
                                            <span>
                                                <input type="radio" name="advCouponCode"
                                                       option-type="adv_single_use_coupons"
                                                       :checked="settings.advocate_coupon_type == 'single'"
                                                       class="control-primary advocate_options">
                                            </span>
                                                                <strong>Single Use Coupons</strong> Unique coupon codes
                                                                for every advocate

                                                            </label>

                                                        </div>
                                                        <div class="coupon_desc" id="advocate-single-use_code"
                                                             v-show="settings.advocate_coupon_type == 'single'"
                                                             style="margin-left:10px;margin-top:15px;">
                                                            <form name="frmAdvSingleUseCodes" id="frmAdvSingleUseCodes"
                                                                  data-container-id="advocate-coupon-details"
                                                                  method="post">
                                                                <div class="col-md-10">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Paste your coupon
                                                                            codes here</label>
                                                                        <div class="">
                                                                            <textarea name="singleCouponCodes"
                                                                                      class="form-control"
                                                                                      placeholder="list of coupon codes"
                                                                                      required="required"
                                                                                      v-html="advocateCoupons.single"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 text-right hidden">
                                                                    <div class="form-group">
                                                                        <label class="control-label">&nbsp;</label>
                                                                        <div>
                                                                            <input type="hidden" name="couponType"
                                                                                   value="advocate_single_coupons"/>
                                                                            <input type="hidden" name="rewardID"
                                                                                   :value="settings.rewardID"/>
                                                                            <button type="submit"
                                                                                    class="btn dark_btn ml20 bkg_dgreen singleCouponCodesSubmit">
                                                                                <span>Save Changes</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="clearfix"></div>

                                                        <div class="radio">
                                                            <label>
                                            <span>
                                                <input type="radio" name="advCouponCode"
                                                       option-type="adv_multiple_use_coupons"
                                                       :checked="settings.advocate_coupon_type == 'multiple'"
                                                       class="control-primary advocate_options">
                                            </span>
                                                                <strong>Multiple Use Coupons</strong> Reusable coupon
                                                                code for all advocates

                                                            </label>

                                                        </div>
                                                        <div class="coupon_desc" id="advocate-multiple-use_code"
                                                             v-show="settings.advocate_coupon_type == 'multiple'"
                                                             style="margin-left:10px;margin-top:15px;">
                                                            <form name="frmAdvMultipleUseCodes"
                                                                  id="frmAdvMultipleUseCodes"
                                                                  data-container-id="advocate-coupon-details"
                                                                  method="post">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Paste your coupon
                                                                            code</label>
                                                                        <div class="">
                                                                            <input type="text" class="form-control"
                                                                                   name="multipleCouponCodes"
                                                                                   :value="advocateCoupons.multiple.coupon_code"
                                                                                   id="multipleCouponCodes"
                                                                                   placeholder="e.g. REWARD10"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Expiry</label>
                                                                        <div class="">
                                                                            <select class="form-control"
                                                                                    v-model="advocateCoupons.multiple.expiry"
                                                                                    id="adv_coupon_expiry"
                                                                                    name="coupon_expiry">
                                                                                <option value="never">
                                                                                    Never(Recommended)
                                                                                </option>
                                                                                <option value="6">6 Months</option>
                                                                                <option value="5">5 Months</option>
                                                                                <option value="4">4 Months</option>
                                                                                <option value="3">3 Months</option>
                                                                                <option value="2">2 Months</option>
                                                                                <option value="1">1 Months</option>
                                                                                <option value="specific-date">Specific
                                                                                    Date
                                                                                </option>
                                                                            </select>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label class="control-label">&nbsp;</label>
                                                                        <div class="">
                                                                            <input type="text"
                                                                                   name="specific_expiry_picker"
                                                                                   class="form-control daterange-single"
                                                                                   id="adv_specific_expiry_picker"
                                                                                   :value="advocateCoupons.multiple.expiry_specific_date"
                                                                                   v-show="advocateCoupons.multiple.expiry == 'specific-date'"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 text-right hidden">
                                                                    <div class="form-group">
                                                                        <label class="control-label">&nbsp;</label>
                                                                        <div>
                                                                            <input type="hidden" name="couponType"
                                                                                   value="advocate_multiple_coupons"/>
                                                                            <input type="hidden" name="rewardID"
                                                                                   :value="settings.rewardID"/>
                                                                            <button type="submit"
                                                                                    class="btn dark_btn ml20 bkg_dgreen multipalCouponCodesSubmit">
                                                                                <span>Save Changes</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="p20">
                                                            <button type="button" class="btn white_btn">
                                                                <span>Cancel</span></button>
                                                            <button type="button"
                                                                    class="btn dark_btn ml20 bkg_dgreen adSaveAll">
                                                                <span>Save Changes</span></button>
                                                        </div>
                                                    </div>


                                                    <!-- *--- end ---* -->

                                                </div>

                                                <div class="advocate_desc" id="advocate-cash-new" v-show="settings.cash_id > 0"
                                                     style="margin-left:10px;margin-top:15px;">
                                                    <form name="frmAdvocateCash" id="frmAdvocateCash" method="post"
                                                          data-container-id="advocate-free-gift">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Amount</label>
                                                                <div class="">
                                                                    <input name="advocate_discount_price"
                                                                           class="form-control" type="text"
                                                                           :value="settings.amount" required
                                                                           placeholder="10">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label class="control-label">&nbsp;</label>
                                                                <div class="">
                                                                    <div class="input-group">
                                                                        <input type="hidden" name="amount_type"
                                                                               class="form-control amount_type"
                                                                               :value="settings.amount_type ? settings.amount_type : 'percent'">
                                                                        <input type="text" name=""
                                                                               :value="advocateGiftProps('amount_type').unit"
                                                                               id="adCashVal" class="form-control"
                                                                               readonly/>
                                                                        <span
                                                                            :style="`display: ${advocateGiftProps('amount_type').dollar};`"
                                                                            class="input-group-addon bkg_dgreen bor_n adCashType"
                                                                            amtSign="%" amtText="percent"><i
                                                                            class="icon-percent txt_white"></i></span>
                                                                        <span
                                                                            :style="`display: ${advocateGiftProps('amount_type').percent};`"
                                                                            class="input-group-addon bkg_dgreen bor_n adCashType"
                                                                            amtSign="$" amtText="dollar"><i
                                                                            class="icon-coin-dollar txt_white"></i></span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label">Reward Message</label>
                                                                <div class="">
                                                                    <input type="text" name="advocate_cash"
                                                                           class="form-control"
                                                                           :value="settings.display_msg ? settings.display_msg : '$10 in cash'"
                                                                           placeholder="e.g. $10 in cash"
                                                                           required="required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 text-right">
                                                            <div class="form-group">
                                                                <label class="control-label">&nbsp;</label>
                                                                <div>
                                                                    <input type="hidden" name="rewardType"
                                                                           value="advocate_cash"/>
                                                                    <input type="hidden" name="rewardID"
                                                                           :value="settings.rewardID"/>
                                                                    <button type="button" class="btn white_btn"><span>Cancel</span>
                                                                    </button>
                                                                    <button type="submit"
                                                                            class="btn dark_btn ml20 bkg_dgreen"><span>Save Changes</span>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="advocate_desc " id="advocate-custom-new"
                                                     v-show="settings.custom_id > 0"
                                                     style="margin-left:10px;margin-top:15px;">
                                                    <form name="frmAdvocateCustom" id="frmAdvocateCustom" method="post"
                                                          data-container-id="advocate-free-gift">

                                                        <div class="col-md-3">

                                                        </div>
                                                        <div class="col-md-1">

                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label">Reward Message</label>
                                                                <div class="">
                                                                    <input type="text" name="advocate_custom"
                                                                           class="form-control"
                                                                           :value="settings.reward_title ? settings.reward_title : 'a free gift'"
                                                                           placeholder="e.g. a free gift"
                                                                           required="required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 text-right">
                                                            <div class="form-group">
                                                                <label class="control-label">&nbsp;</label>
                                                                <div>
                                                                    <input type="hidden" name="rewardType"
                                                                           value="advocate_custom"/>
                                                                    <input type="hidden" name="rewardID"
                                                                           :value="settings.rewardID"/>
                                                                    <button type="button" class="btn white_btn"><span>Cancel</span>
                                                                    </button>
                                                                    <button type="submit"
                                                                            class="btn dark_btn ml20 bkg_dgreen"><span>Save Changes</span>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>

                                            <div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="friendTabSetup" class="tab-pane fade">
                            <h3>Friend setup goes here</h3>
                        </div>
                    </div>
                </div>


                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(1)"><span
                            class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(3)">Save and
                            continue <span><img
                                src="/assets/images/arrow-right-line.svg"></span></button>
                    </div>
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
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},
                settings: '',
                advocateCouponsCollection: '',
                advocateGiftType:'',
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                fromNumber: '',
                displayCustomLinkExpiry: false
            }
        },
        created() {
            axios.get('/admin/modules/referral/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oReferral;
                    this.settings = response.data.oSettings;
                    this.advocateCouponsCollection = response.data.oAdvCouponCodes;
                    this.loading = false;
                    //loadJQScript(this.user.id);

                });
        },
        mounted() {

        },
        computed: {
            advocateCoupons: function () {
                if (this.advocateCouponsCollection != '') {
                    let advocateSingleCouponArray = [];
                    let advocateMultipleCouponArray = [];
                    this.advocateCouponsCollection.forEach(function (val, index) {
                        if (val.usage_type == 'single') {
                            advocateSingleCouponArray.push(val.coupon_code);
                        }
                        if (val.usage_type == 'multiple') {
                            advocateMultipleCouponArray = val;
                        }
                    });
                    return {
                        'single': advocateSingleCouponArray.join(","),
                        'multiple': advocateMultipleCouponArray
                    }
                }
            }
        },
        methods: {
            advocateGiftProps: function (fieldName) {
                let param = '';
                let advData='';
                if (fieldName == 'advocate_discount_type') {
                    param = this.settings.advocate_discount_type;
                }

                if (fieldName == 'amount_type') {
                    param = this.settings.amount_type;
                }
                if (param == 'dollar') {
                    advData = {
                        unit: '$',
                        dollar: 'table-cell',
                        percent: 'none'
                    };
                } else if (param == 'percent') {
                    advData = {
                        unit: '%',
                        dollar: 'none',
                        percent: 'table-cell'
                    };
                } else {
                    advData = {
                        unit: '%',
                        dollar: 'none',
                        percent: 'table-cell'
                    };
                }
                return advData;
            },
            displayStep: function (step) {
                let path = '';
                if (!step) {
                    path = '/admin#/referral/';
                } else {
                    path = '/admin#/referral/setup/' + this.campaignId + '/' + step;
                }

                window.location.href = path;
            },
            updateSettings: function (fieldName, fieldValue, type) {
                this.loading = true;

                if (type == 'expiry') {
                    this.displayCustomLinkExpiry = fieldValue == 'custom' || fieldName == 'txtInteger' || fieldName == 'exp_duration' ? true : false;
                }
                axios.post('/admin/brandboost/saveOnsiteSettings', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    brandboostId: this.campaignId,
                    linkExpiryData: this.campaign.link_expire_custom,
                    requestType: type

                }).then(response => {
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.loading = false;
                });

            },
            saveDraft: function () {
                this.loading = true;
                axios.post('/admin/broadcast/updateBroadcast', {
                    broadcastId: this.campaignId,
                    status: 'draft',
                    current_state: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if (response.data.status == 'success') {
                            this.successMsg = 'Campaign saved as a draft successfully';
                        } else {
                            this.errorMsg = 'Something went wrong';
                        }
                    });
            }
        }

    };

</script>
<style scoped>
    .email_config_list li {
        width: 19.5% !important;
    }

    .tab-content {
        width: 100%;
        padding: 50px 0 !important;
    }

    .nav-tabs > li {
        float: left;
        margin-bottom: -1px;
        width: 50%;
        padding: 1rem !important
    }

    .nav-tabs {
        border-bottom: 1px solid #ddd;
        width: 100%;
    }

    .nav-tabs > li.active {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }

    .select_section {
        width: 100%;
        max-width: 1140px;
        margin: 0 auto;
    }

    .select_section label.m0 {
        width: 100% !important;
    }

    .broadcast_select_contact {
        width: 100%;
        margin: 0 0px;
        display: inline-block;
        height: 323px;
        border-radius: 6px;
        box-shadow: 0 3px 5px 0 rgba(1, 21, 64, 0.06);
        padding: 35px 20px;
        background: #fff;
        text-align: center;
        position: relative;
        cursor: pointer;
    }

    .broadcast_select_contact.ref {
        height: auto;
    }

    .broadcast_select_contact .img_box {
        width: 170px;
        margin: 0 auto;
        text-align: center;
        margin-bottom: 20px;
    }

    .broadcast_select_contact .img_box img {
        height: 125px;
    }

    .broadcast_select_contact.ref .img_box img {
        height: 104px;
    }

    .broadcast_select_contact p {
        max-width: 193px;
        margin: 0 auto 10px;
    }

    .broadcast_select_contact .custmo_checkbox {
        position: absolute;
        top: 0px;
        right: 0px;
        height: 32px;
        width: 32px;
        padding-left: 32px;
    }

    .broadcast_select_contact .custmo_checkmark {
        border-radius: 4px;
        border: none;
        height: 32px;
        width: 32px;
    }

    .broadcast_select_contact .custmo_checkmark::after {
        left: 19px;
        top: 5px;
        width: 5px;
        height: 8px;
        border-width: 0 2px 2px 0;
    }

    .custmo_checkbox input:checked ~ .custmo_checkmark.green_tr {
        border: none !important;
        background: url(/assets/images/checkmark_bkg_green.png) top right no-repeat !important;
    }

    .custmo_checkbox input:checked ~ .custmo_checkmark.blue_tr {
        border: none !important;
        background: url(/assets/images/checkmark_bkg_blue_big.png) top right no-repeat !important;
    }

    .custmo_checkbox input:checked ~ .custmo_checkmark.purple_tr {
        border: none !important;
        background: url(/assets/images/checkmark_bkg_purple.png) top right no-repeat !important;
    }

</style>



