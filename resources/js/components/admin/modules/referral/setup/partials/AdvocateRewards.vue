<template>
    <div>
        <div class="row mb30">
            <div class="col-md-4 text-center">
                <label for="temp1" class="m0 w-100">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input
                                class="check"
                                type="radio"
                                id="temp1"
                                v-model="form.rewardType"
                                value="advocate_discount"
                                name="advocateGiftType"
                                >
                            <span class="custmo_checkmark green_tr"></span>
                        </label>
                        <div class="img_box img_active" v-if="form.rewardType == 'advocate_discount'"><img
                            src="http://brandboost.io/assets/images/ref_reward_1_act.png"></div>
                        <div class="img_box img_inactive" v-else><img
                            src="http://brandboost.io/assets/images/ref_reward_1.png"></div>
                        <p class="fsize14 txt_dark fw500">Coupon</p>
                        <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
                    </div>
                </label>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp2" class="m0 w-100">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input
                                type="radio"
                                class="check"
                                id="temp2"
                                v-model="form.rewardType"
                                value="advocate_cash"
                                name="advocateGiftType"
                            >
                            <span class="custmo_checkmark green_tr"></span>
                        </label>
                        <div class="img_box img_active" v-if="form.rewardType == 'advocate_cash'"><img
                            src="http://brandboost.io/assets/images/ref_reward_2_act.png"></div>
                        <div class="img_box img_inactive" v-else><img
                            src="http://brandboost.io/assets/images/ref_reward_2.png"></div>
                        <p class="fsize14 txt_dark fw500">Cash</p>
                        <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
                    </div>
                </label>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp3" class="m0 w-100">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input
                                type="radio"
                                class="check"
                                id="temp3"
                                name="advocateGiftType"
                                v-model="form.rewardType"
                                value="advocate_custom"
                                >
                            <span class="custmo_checkmark green_tr"></span></label>
                        <div class="img_box img_active" v-if="form.rewardType == 'advocate_custom'"><img
                            src="http://brandboost.io/assets/images/ref_reward_3_act.png"></div>
                        <div class="img_box img_inactive" v-else><img
                            src="http://brandboost.io/assets/images/ref_reward_3.png"></div>
                        <p class="fsize14 txt_dark fw500">Custom</p>
                        <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
                    </div>
                </label>
            </div>
        </div>
        <div class="row" v-if="form.rewardType=='advocate_discount'">
            <div class="col-md-12">
                <div class="card p40 min_h_240">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="htxt_bold_16 dark_700 mb10">Gift Configuration</h3>
                            <p class="fsize12 fw300 dark_300 mb20">This text will be displayed in the ‘Subject’ field in
                                your recepient’s email client.</p>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Amount</label>
                                <div class="">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="form.advocate_discount_price"
                                        required=""
                                        placeholder="10"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="">
                                    <div class="input-group mb-3">
                                        <button
                                            type="button"
                                            v-model="form.advocate_discount_type"
                                            value="%"
                                            class="form-control">%</button>
                                        <button
                                            type="button"
                                            v-model="form.advocate_discount_type"
                                            value="$"
                                            class="form-control"
                                            style="background-color:#e9ecef;">$</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">Reward Message</label>
                                <div class="">
                                    <input
                                        type="text"
                                        v-model="form.advocate_discount"
                                        class="form-control"
                                        placeholder="e.g. 20% off"
                                        required="required"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border p20 bkg_light_050 shadow-none mt30 mb0">
                        <div class="radio">
                            <label>
                                <span class="float-left" style="margin: 2px 8px 0 0">
                                    <input
                                        type="radio"
                                        name="advCouponCode"
                                        v-model="couponType"
                                        value="advocate_single_coupons"
                                        class="control-primary advocate_options"
                                    >
                                    </span>
                                <strong>Single Use Coupons</strong> Unique coupon codes for every advocate
                            </label>
                        </div>
                        <!--Single Use Coupon Form-->
                        <div class="coupon_desc p20" style="display: block;">
                            <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="control-label">Paste your coupon codes here</label>
                                            <div class="">
                                                <textarea
                                                    v-model="singleCouponCodes"
                                                    class="form-control fsize13 p20"
                                                    placeholder="list of coupon codes"
                                                    required>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div>
                                                <button
                                                    type="button"
                                                    class="btn btn-md bkg_email_300 light_000 pl20 pr20"
                                                    @click="saveSingleCoupon"
                                                >
                                                    Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!--End of Single Use Coupon Form-->
                        <div class="radio">
                            <label>
                                <span class="float-left" style="margin: 2px 8px 0 0">
                                    <input
                                        type="radio"
                                        name="advCouponCode"
                                        v-model="couponType"
                                        value="advocate_multiple_coupons"
                                        class="control-primary advocate_options"
                                    >
                                    </span>
                                <strong>Multiple Use Coupons</strong> Reusable coupon code for all advocates
                            </label>
                        </div>
                        <div class="coupon_desc p20" style="display: block;">
                            <!--Multiuse Coupon Form-->
                            <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Paste your coupon code</label>
                                            <div class="">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="multipleCouponCodes"
                                                    name="multipleCouponCodes"
                                                    value="Test1"
                                                    placeholder="e.g. REWARD10"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Expiry</label>
                                            <div class="">
                                                <select
                                                    class="form-control"
                                                    v-model="coupon_expiry"
                                                    name="coupon_expiry">
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
                                                <input
                                                    type="text"
                                                    v-model="specific_expiry_picker"
                                                    class="form-control daterange-single">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div>
                                                <button
                                                    type="button"
                                                    class="btn btn-md bkg_email_300 light_000 pl20 pr20"
                                                    @click="saveMultipleCoupons"
                                                >
                                                    <span>Save Changes</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!--End of Multiuse Coupon Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt20" style="display: none;">
            <div class="col-md-12">
                <div class="white_box p20 pl30 pr30">
                    <div class="row advocateGiftHeading">
                        <div class="col-md-12 mb20">
                            <p class="fsize15 bbot pb-15">Gift Configurationn</p>
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
                advocateGiftType: '',
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                fromNumber: '',
                displayCustomLinkExpiry: false,
                form: {
                    rewardType: '',
                    advocate_discount_price: '',
                    couponType: ''
                },


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
                    this.initializeDefaults();
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
            initializeDefaults: function(){
                if(this.settings.adv_coupon_id>0){
                    this.form.rewardType = 'advocate_discount';
                }else if(this.settings.cast_id>0){
                    this.form.rewardType = 'advocate_cash';
                }else if(this.settings.custom_id>0){
                    this.form.rewardType = 'advocate_custom';
                }
            },
            advocateGiftProps: function (fieldName) {
                let param = '';
                let advData = '';
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




