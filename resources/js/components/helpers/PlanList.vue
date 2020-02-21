<template>
    <div class="row monthly_pricing_plan" v-if="(oCurrentPlanData != '' && (oCurrentPlanData.subs_cycle != 'month' || oCurrentPlanData.subs_cycle != 'monthly') && oCurrentPlanData.level_name != 'Pro')" style="display:none;">
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

                    <button v-if="isMembershipActive" type="button" class="btn white_btn w100 h40 txt_purple"><span>Active</span> </button>

                    <button v-else type="button" class="btn dark_btn w100 bkg_purple h40 confirmManualUpgrade" :plan_id="oMembership.plan_id" :plan_name="oMembership.level_name">
                        <span v-if="oCurrentPlanData == ''">Buy</span>
                        <span v-if="isMembershipActive != ''">Upgrade</span>
                        <span v-else>Downgrade</span>
                    </button>
                </div>
            </div>
        </div>
        <!--//End Pricing -->
    </div>

    <div class="row yearly_pricing_plan" v-if="(!((oCurrentPlanData.subs_cycle == 'yearly' || oCurrentPlanData.subs_cycle == 'year') || (oCurrentPlanData.level_name == 'Pro')))" style="display:none;">
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

                    <button v-if="isMembershipActive" type="button" class="btn white_btn w100 txt_purple h40"><span>Active</span> </button>

                    <button v-else type="button" class="btn dark_btn w100 bkg_purple h40 confirmManualUpgrade" :plan_id="oMembership.plan_id" :plan_name="oMembership.level_name">
                        <span v-if="(isMembershipActive != '' && oCurrentPlanData.level_name == 'Pro')">Upgrade</span>
                        <span v-else>Downgrade</span>
                    </button>
                </div>
            </div>
        </div>
        <!--//End Pricing -->
    </div>
</template>

<script>
    export default {
        name: 'planlists',
        props: [oMemberships, isMembershipActive, oUser, oCurrentPlanData],
        computed: {

        },
        methods: {

        }
    }

    $(document).ready(function () {
        $(".dispUpgradePlan").click(function () {
            var billtype = $(this).attr("data-cycle");
            if (billtype == 'monthly') {
                $("#monthly_pricing_plan, .monthly_pricing_plan").show();
                $("#yearly_pricing_plan, .yearly_pricing_plan").hide();
            }

            if (billtype == 'yearly') {
                $("#yearly_pricing_plan, .yearly_pricing_plan").show();
                $("#monthly_pricing_plan, .monthly_pricing_plan").hide();
            }
        });
    });
</script>
