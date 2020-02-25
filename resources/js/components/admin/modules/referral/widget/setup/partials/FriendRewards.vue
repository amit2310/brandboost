<template>
    <div>
        <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
        <loading :isLoading="loading"></loading>
        <div class="row mb30">
            <div class="col-md-4 text-center">
                <label for="temp4" class="m0 w-100">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input
                                class="check"
                                type="radio"
                                id="temp4"
                                v-model="form.rewardType"
                                value="referred_discount"
                                name="referredGiftType"
                            >
                            <span class="custmo_checkmark green_tr"></span>
                        </label>
                        <div class="img_box img_active" v-if="form.rewardType == 'referred_discount'"><img
                            src="http://brandboost.io/assets/images/ref_reward_1_act.png"></div>
                        <div class="img_box img_inactive" v-else><img
                            src="http://brandboost.io/assets/images/ref_reward_1.png"></div>
                        <p class="fsize14 txt_dark fw500">Coupon</p>
                        <p class="fsize12 txt_grey fw300">Coupon discount for Friends</p>
                    </div>
                </label>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp5" class="m0 w-100">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input
                                type="radio"
                                class="check"
                                id="temp5"
                                v-model="form.rewardType"
                                value="referred_promo"
                                name="referredGiftType"
                            >
                            <span class="custmo_checkmark green_tr"></span>
                        </label>
                        <div class="img_box img_active" v-if="form.rewardType == 'referred_promo'"><img
                            src="http://brandboost.io/assets/images/ref_reward_2_act.png"></div>
                        <div class="img_box img_inactive" v-else><img
                            src="http://brandboost.io/assets/images/ref_reward_2.png"></div>
                        <p class="fsize14 txt_dark fw500">Promo Link</p>
                        <p class="fsize12 txt_grey fw300">Promo link for friends</p>
                    </div>
                </label>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp6" class="m0 w-100">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input
                                type="radio"
                                class="check"
                                id="temp6"
                                name="referredGiftType"
                                v-model="form.rewardType"
                                value="referred_no_discount"
                            >
                            <span class="custmo_checkmark green_tr"></span></label>
                        <div class="img_box img_active" v-if="form.rewardType == 'referred_no_discount'"><img
                            src="http://brandboost.io/assets/images/ref_reward_3_act.png"></div>
                        <div class="img_box img_inactive" v-else><img
                            src="http://brandboost.io/assets/images/ref_reward_3.png"></div>
                        <p class="fsize14 txt_dark fw500">Custom</p>
                        <p class="fsize12 txt_grey fw300">Custom discount for friends</p>
                    </div>
                </label>
            </div>
        </div>
        <!--Coupons Reward-->
        <div class="row" v-if="form.rewardType=='referred_discount'">
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
                                        v-model="settings.referred_display_msg"
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
                                        @click="saveReferredReward('coupon')"
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
                                        name="refCouponCode"
                                        v-model="settings.referred_coupon_type"
                                        value="single"
                                        class="control-primary advocate_options"
                                    >
                                    </span>
                                <strong>Single Use Coupons</strong> Unique coupon codes for every friend
                            </label>
                        </div>
                        <!--Single Use Coupon Form-->
                        <div class="coupon_desc p20" v-if="settings.referred_coupon_type == 'single'">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="control-label">Paste your coupon codes here</label>
                                        <div class="">
                                                <textarea
                                                    v-model="referredCoupons.single"
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
                                                @click.prevent="saveReferredCoupon('single')"
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
                                        name="refCouponCode"
                                        v-model="settings.referred_coupon_type"
                                        value="multiple"
                                        class="control-primary advocate_options"
                                    >
                                    </span>
                                <strong>Multiple Use Coupons</strong> Reusable coupon code for all friends
                            </label>
                        </div>
                        <div class="coupon_desc p20" v-if="settings.referred_coupon_type == 'multiple'">
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
                                                v-model="referredCoupons.multiple.coupon_code"
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
                                                v-model ="referredCoupons.multiple.expiry"
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
                                                v-if="referredCoupons.multiple.expiry == 'specific-date'"
                                                v-model ="referredCoupons.multiple.specific_expiry_picker"
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
                                                @click.prevent="saveReferredCoupon('multiple')"
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
        <div class="row" v-if="form.rewardType=='referred_promo'">
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
                                <label class="control-label">Promo Link</label>
                                <div class="">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="settings.link_url"
                                        required=""
                                        placeholder="e.g. http://yourstore.com/discount/link"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Give Friends</label>
                                <div class="">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="settings.link_desc"
                                        required=""
                                        placeholder="e.g. 20% off"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Expiry</label>
                                <div class="">
                                    <select
                                        class="form-control"
                                        name="coupon_expiry"
                                        v-model ="settings.expiry"
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
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="">
                                    <input
                                        type="text"
                                        v-if="settings.expiry == 'specific-date'"
                                        v-model ="settings.specific_expiry_picker"
                                        class="form-control daterange-single">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 pr-5 text-right">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="pr-2">
                                    <button
                                        type="button"
                                        class="btn btn-md bkg_email_300 light_000 pl20 pr20"
                                        @click="saveReferredReward('cash')"
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
        <div class="row" v-if="form.rewardType=='referred_no_discount'">
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
                                        @click="saveReferredReward('custom')"
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
                successMsg: '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},
                settings: '',
                referredCouponsCollection: '',
                referredGiftType: '',
                user: {},
                breadcrumb: '',
                feedbackResponse: '',
                fromNumber: '',
                displayCustomLinkExpiry: false,
                form: {
                    rewardType: '',
                    referred_discount_price: '',
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
                    this.referredCouponsCollection = response.data.oRefCouponCodes;
                    this.loading = false;
                    this.initializeDefaults();
                });
        },
        computed: {
            referredCoupons: function () {
                if (this.referredCouponsCollection != '') {
                    let referredSingleCouponArray = [];
                    let referredMultipleCouponArray = [];
                    this.referredCouponsCollection.forEach(function (val, index) {
                        if (val.usage_type == 'single') {
                            referredSingleCouponArray.push(val.coupon_code);
                        }
                        if (val.usage_type == 'multiple') {
                            referredMultipleCouponArray = val;
                        }
                    });
                    return {
                        'single': referredSingleCouponArray.join(","),
                        'multiple': referredMultipleCouponArray
                    }
                }
            }
        },
        methods: {
            saveReferredReward: function(rType){
                let form = {};
                form.rewardID = this.settings.rewardID;
                if(rType == 'coupon'){
                    form.rewardType = 'referred_discount';
                    form.referred_discount = this.settings.referred_display_msg; //Reward Message

                }
                if(rType == 'cash'){
                    form.rewardType = 'referred_promo';
                    form.referred_promo_link = this.settings.link_url;
                    form.referred_promo_desc = this.settings.link_desc;
                    form.promo_expiry = this.settings.expiry;
                    form.specific_expiry_picker = this.settings.specific_expiry_picker;
                }
                if(rType == 'custom'){
                    form.rewardType = 'referred_no_discount';
                    form.advocate_custom = this.settings.reward_title;
                }
                this.saveRewardSettings(form);
            },
            saveRewardSettings: function(formData){
                this.loading = true;
                axios.post('/admin/modules/referral/saveRewards', formData)
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.loading = false;
                            this.successMsg = 'Reward setup saved successfully!';
                        }
                    });
            },
            saveReferredCoupon: function(couponType){
                let form = {};
                form.rewardID = this.settings.rewardID;
                if(couponType == 'single'){
                    form.couponType = 'referred_single_coupons';
                    form.singleCouponCodes = this.referredCoupons.single;
                }
                if(couponType == 'multiple'){
                    form.couponType = 'referred_multiple_coupons';
                    form.multipleCouponCodes = this.referredCoupons.multiple.coupon_code
                    form.coupon_expiry = this.referredCoupons.multiple.expiry;
                    form.specific_expiry_picker = this.referredCoupons.multiple.specific_expiry_picker;
                }
                this.saveRewardCoupons(form);
            },
            saveRewardCoupons: function(formData){
                this.loading = true;
                axios.post('/admin/modules/referral/saveCoupons', formData)
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.loading = false;
                            this.successMsg = 'Reward coupons saved successfully!';
                        }
                    });
            },
            initializeDefaults: function(){
                if(this.settings.ref_coupon_id>0){
                    this.form.rewardType = 'referred_discount';
                }else if(this.settings.promo_id>0){
                    this.form.rewardType = 'referred_promo';
                }else if(this.settings.no_discount == 'yes'){
                    this.form.rewardType = 'referred_no_discount';
                }
            }
        }

    };

</script>
<style scoped>
    button.active {background-color:#0bbf20 !important;color:#FFFFFF !important;}
</style>




