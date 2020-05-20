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
        <!--Coupons Reward-->
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
                                        v-model="settings.advocate_discount"
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
                                            v-model="settings.advocate_discount_type"
                                            :class="{'active' : settings.advocate_discount_type == 'percent'}"
                                            value="percent"
                                            @click="settings.advocate_discount_type = 'percent'"
                                            class="form-control">%</button>
                                        <button
                                            type="button"
                                            :class="{'active' : settings.advocate_discount_type == 'dollar'}"
                                            value="dollar"
                                            class="form-control"
                                            @click="settings.advocate_discount_type = 'dollar'"
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
                                        v-model="settings.advocate_display_msg"
                                        class="form-control"
                                        placeholder="e.g. 20% off"
                                        required="required"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 pr-5 text-right">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="pr-2">
                                    <button
                                        type="button"
                                        class="btn btn-md bkg_email_300 light_000 pl20 pr20"
                                        @click="saveAdvocateReward('coupon')"
                                    >
                                        <span>Save Changes</span></button>
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
                                        v-model="settings.advocate_coupon_type"
                                        value="single"
                                        class="control-primary advocate_options"
                                    >
                                    </span>
                                <strong>Single Use Coupons</strong> Unique coupon codes for every advocate
                            </label>
                        </div>
                        <!--Single Use Coupon Form-->
                        <div class="coupon_desc p20" v-if="settings.advocate_coupon_type == 'single'">
                            <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="control-label">Paste your coupon codes here</label>
                                            <div class="">
                                                <textarea
                                                    v-model="advocateCoupons.single"
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
                                                    @click.prevent="saveAdvocateCoupon('single')"
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
                                        v-model="settings.advocate_coupon_type"
                                        value="multiple"
                                        class="control-primary advocate_options"
                                    >
                                    </span>
                                <strong>Multiple Use Coupons</strong> Reusable coupon code for all advocates
                            </label>
                        </div>
                        <div class="coupon_desc p20" v-if="settings.advocate_coupon_type == 'multiple'">
                            <!--Multiuse Coupon Form-->
                            <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Paste your coupon code</label>
                                            <div class="">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="multipleCouponCodes"
                                                    v-model="advocateCoupons.multiple.coupon_code"
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
                                                    name="coupon_expiry"
                                                    v-model ="advocateCoupons.multiple.expiry"
                                                >
                                                    <option value="never">Never(Recommended)</option>
                                                    <option value="6">6 Months</option>
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
                                                    v-if="advocateCoupons.multiple.expiry == 'specific-date'"
                                                    v-model ="advocateCoupons.multiple.specific_expiry_picker"
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
                                                    @click.prevent="saveAdvocateCoupon('multiple')"
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

        <!--Cash Reward-->
        <div class="row" v-if="form.rewardType=='advocate_cash'">
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
                                        v-model="settings.amount"
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
                                            v-model="settings.amount_type"
                                            :class="{'active' : settings.amount_type == 'percent'}"
                                            value="percent"
                                            @click="settings.amount_type = 'percent'"
                                            class="form-control">%</button>
                                        <button
                                            type="button"
                                            :class="{'active' : settings.amount_type == 'dollar'}"
                                            value="dollar"
                                            class="form-control"
                                            @click="settings.amount_type = 'dollar'"
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
                                        v-model="settings.display_msg"
                                        class="form-control"
                                        placeholder="e.g. $10 in cash"
                                        required="required"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 pr-5 text-right">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="pr-2">
                                    <button
                                        type="button"
                                        class="btn btn-md bkg_email_300 light_000 pl20 pr20"
                                        @click="saveAdvocateReward('cash')"
                                    >
                                        <span>Save Changes</span></button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!--Custom Reward-->
        <div class="row" v-if="form.rewardType=='advocate_custom'">
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
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">Reward Message</label>
                                <div class="">
                                    <input
                                        type="text"
                                        v-model="settings.reward_title"
                                        class="form-control"
                                        placeholder="e.g. a free gift"
                                        required="required"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 pr-5 text-right">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="pr-2">
                                    <button
                                        type="button"
                                        class="btn btn-md bkg_email_300 light_000 pl20 pr20"
                                        @click="saveAdvocateReward('custom')"
                                    >
                                        <span>Save Changes</span></button>
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
        data() {
            return {
                refreshMessage: 1,



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
                    couponType: '',
                    singleCouponCodes: '',
                    multipleCouponCodes: '',
                    coupon_expiry: '',
                    specific_expiry_picker: ''
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
                    this.showLoading(false);
                    this.initializeDefaults();
                    //loadJQScript(this.user.id);

                });
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
            saveAdvocateReward: function(rType){
                let form = {};
                form.rewardID = this.settings.rewardID;
                if(rType == 'coupon'){
                    form.rewardType = 'advocate_discount';
                    form.advocate_discount = this.settings.advocate_display_msg; //Reward Message
                    form.advocate_discount_price = this.settings.advocate_discount;
                    form.advocate_discount_type = this.settings.advocate_discount_type;
                }
                if(rType == 'cash'){
                    form.rewardType = 'advocate_cash';
                    form.advocate_discount_price = this.settings.amount;
                    form.amount_type = this.settings.amount_type;
                    form.advocate_cash = this.settings.display_msg;
                }
                if(rType == 'custom'){
                    form.rewardType = 'advocate_custom';
                    form.advocate_custom = this.settings.reward_title;
                }
                this.saveRewardSettings(form);
            },
            saveRewardSettings: function(formData){
              this.showLoading(true);
                axios.post('/admin/modules/referral/saveRewards', formData)
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.showLoading(false);
                            this.displayMessage('success', 'Reward setup saved successfully!');
                        }
                    });
            },
            saveAdvocateCoupon: function(couponType){
                let form = {};
                form.rewardID = this.settings.rewardID;
                if(couponType == 'single'){
                    form.couponType = 'advocate_single_coupons';
                    form.singleCouponCodes = this.advocateCoupons.single;
                }
                if(couponType == 'multiple'){
                    form.couponType = 'advocate_multiple_coupons';
                    form.multipleCouponCodes = this.advocateCoupons.multiple.coupon_code
                    form.coupon_expiry = this.advocateCoupons.multiple.expiry;
                    form.specific_expiry_picker = this.advocateCoupons.multiple.specific_expiry_picker;
                }
                this.saveRewardCoupons(form);
            },
            saveRewardCoupons: function(formData){
                this.showLoading(true);
                axios.post('/admin/modules/referral/saveCoupons', formData)
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.showLoading(false);
                            this.displayMessage('success', 'Reward coupons saved successfully!');
                        }
                    });
            },
            initializeDefaults: function(){
                if(this.settings.adv_coupon_id>0){
                    this.form.rewardType = 'advocate_discount';
                }else if(this.settings.cash_id>0){
                    this.form.rewardType = 'advocate_cash';
                }else if(this.settings.custom_id>0){
                    this.form.rewardType = 'advocate_custom';
                }
            }
        }

    };

</script>
<style scoped>
    button.active {background-color:#0bbf20 !important;color:#FFFFFF !important;}
</style>




