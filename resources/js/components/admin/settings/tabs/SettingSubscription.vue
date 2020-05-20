<template>
    <div>
        <!--******************Top Heading area **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Brand Settings</h3>
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li><a href="#/settings/general" tyle="cursor:pointer; padding: 5px;">General&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/preferences" style="cursor:pointer; padding: 5px;"> Preferences&nbsp;</a></li>&nbsp;&nbsp;
                            <li  class="active"><a href="#/settings/subscription" style="cursor:pointer; padding: 5px;">Subscription & Credits&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/billing" style="cursor:pointer; padding: 5px;">Billing&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/notification" style="cursor:pointer; padding: 5px;">Notifications&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/import" style="cursor:pointer; padding: 5px;">Import&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/export" style="cursor:pointer;">Export</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
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
<!--                                <div class="col-md-3 col-xs-3">-->
<!--                                    <p class="pull-left text-muted fsize13 mr-20">Billing Type:</p>-->
<!--                                    <div class="btn-group display-inline-block">-->
<!--                                        <button id="grid" type="button" class="btn btn-xs btn-default dispUpgradePlan" data-cycle="yearly">Annual</button>-->
<!--                                        <button id="list" type="button" class="btn btn-xs btn-default dispUpgradePlan" data-cycle="monthly">Monthly</button>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="col-md-3 col-xs-3">
                                    <p class="pull-left text-muted fsize13 mr-20">Billing Type:</p>
                                    <div class="btn-group display-inline-block">
                                        <button id="grid" type="button" class="btn btn-xs btn-default" @click="dispUpgradePlan('yearly')">Annual</button>
                                        <button id="list" type="button" class="btn btn-xs btn-default" @click="dispUpgradePlan('monthly')">Monthly</button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!--@include('admin.modals.upgrade.partial.plan_list')-->
<!--                            <div class="row monthly_pricing_plan" v-if="(oCurrentPlanData != '' && (oCurrentPlanData.subs_cycle != 'month' || oCurrentPlanData.subs_cycle != 'monthly') && oCurrentPlanData.level_name != 'Pro')">-->
                            <div class="row monthly_pricing_plan" v-if="(oCurrentPlanData != '' && (oCurrentPlanData.subs_cycle == 'month' || oCurrentPlanData.subs_cycle == 'monthly'))">
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

                                            <button v-else type="button" class="btn dark_btn w100 bkg_purple h40 confirmManualUpgrade"
                                                    data-target="#confirm_level_upgrade"
                                                    @click="confirmTopupUpgradePopup(oMembership.credits,oMembership.price,oMembership.plan_id,oMembership.level_name,oUser.plan_id)" >
                                                <span v-if="oCurrentPlanData == ''">Buy</span>
                                                <span v-else-if="oMembership.isMembershipActive != ''">Upgrade</span>
                                                <span v-else>Downgrade</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--//End Pricing -->
                            </div>
                            <div class="row yearly_pricing_plan" v-if="(((oCurrentPlanData.subs_cycle == 'yearly' || oCurrentPlanData.subs_cycle == 'year') || (oCurrentPlanData.level_name == 'Pro')))">
                                <!-- Pricing -->
                                <div v-for="oMembership in oMemberships" class="col-xs-4" v-if="((oMembership.type == 'membership') && (oMembership.subs_cycle == 'yearly' || oMembership.subs_cycle == 'year'))">
                                    <div class="price_plan">
                                        <div class="imgicon">

                                            <img v-if="oMembership.level_name == 'Starter Yearly'" src="/assets/images/starter_icon.png"/>
                                            <img v-else-if="oMembership.level_name == 'Business Yearly'" src="/assets/images/business_icon.png"/>
                                            <img v-else-if="oMembership.level_name == 'Pro Yearly'" src="/assets/images/pro_icon.png"/>
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

                                            <button v-else type="button" class="btn dark_btn w100 bkg_purple h40 confirmManualUpgrade"
                                                    data-toggle="modal" data-target="#confirm_level_upgrade"
                                                    @click="confirmTopupUpgradePopup(oMembership.credits,oMembership.price,oMembership.plan_id,oMembership.level_name,oUser.plan_id)" >
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
                                            <button v-else type="button" class="btn dark_btn w100 bkg_purple h40 confirmTopupUpgrade"
                                                    @click="confirmTopupUpgradePopup(oMembership.credits,oMembership.price,oMembership.plan_id,oMembership.level_name,oUser.topup_plan_id)" data-toggle="modal" data-target="#confirm_topup_level_upgrade">
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
                                            <button type="button" class="btn dark_btn w100 bkg_purple h40 " @click="confirmBuyCustomAddonPopup(oMembership.credits,oMembership.price,oMembership.plan_id,oMembership.level_name)" :topup_plan_name="oMembership.level_name" :topup_plan_id="oMembership.plan_id" :topup_plan_price="oMembership.price" data-toggle="modal" data-target="#confirm_buy_addon_plan"><span>Buy</span> </button>

<!--                                            <button type="button" class="btn dark_btn w100 bkg_purple h40 confirmBuyAddon" :topup_plan_name="oMembership.level_name" :topup_plan_id="oMembership.plan_id" :topup_plan_price="oMembership.price" data-toggle="modal" data-target="#confirm_buy_addon_plan"><span>Buy</span> </button>-->
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
                                            <input class="form-control" value="1000" name="txtCustomQty" id="txtCustomQty" type="text" title="Enter quantity of credits" placeholder="1000">
                                            <span class="input-group-addon" id="customprice">${{ (oMembership.price * 1000) }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-1 col-xs-1">
                                        <p class="fsize13">&nbsp;</p>
                                        <button type="button" class="btn dark_btn w100 bkg_purple h40 " @click="confirmBuyCustomAddonPopup('1000','10','custom-pack','Custom Pack')" :topup_plan_name="oMembership.level_name" :topup_plan_id="oMembership.plan_id" :topup_plan_price="oMembership.price" data-toggle="modal" data-target="#confirm_buy_custom_addon_plan"><span>Buy</span> </button>
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
        <!-- Upgrade plan Modal Confirm -->
        <div id="confirm_level_upgrade" class="modal fade">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Confirm Upgrade</h5>
                    </div>

                    <div class="modal-body">
                        <h6 class="text-semibold">Upgrade Your Account</h6>

                        <table class="table table-hover table-striped table-bordered text-left mb-20">
                            <tr>
                                <td>Name :</td>
                                <td>
                                    {{ oUser.firstname +' ' + oUser.lastname }}
                                </td>
                            </tr>
                            <tr>
                                <td>Email :</td>
                                <td>
                                    {{ oUser.email }}
                                </td>
                            </tr>
                            <tr>
                                <td>Phone :</td>
                                <td>
                                    {{ oUser.mobile }}
                                </td>
                            </tr>
                            <tr>
                                <td>Current Plan :</td>
                                <td>

                                    <template v-if="buyCredits.currentPlanName === 'small-businesses-yearly'">Starter Yearly</template>
                                    <template v-else-if="buyCredits.currentPlanName === 'medium-businesses-yearly'">Medium Businesses Yearly</template>
                                    <template v-else-if="buyCredits.currentPlanName === 'big-businesses-yearly'">Pro Yearly</template>
                                </td>
                            </tr>
                            <tr>
                                <td>Upgrade to :</td>
                                <td>
                                    <span id="upgradedPlanTitle">
                                        {{buyCredits.planName}}
                                    </span>
                                </td>
                            </tr>
                        </table>
                        <div class="checkbox">
                            <label>
                                <div class="border-primary-600 text-primary-800">
                                    <input class="control-primary" v-model="buyCredits.acceptTerms" type="checkbox">
                                    I accept terms & condition
                                </div>
                                <span style="color:red;">{{buyCredits.selectTerms}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                        <button type="button" class="btn btn-primary"  @click="confirmLevelUpgrade()">Yes, Upgrade Now</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Upgrade plan Modal Confirm -->
        <div id="confirm_topup_level_upgrade" class="modal fade">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Confirm Upgrade</h5>
                    </div>

                    <div class="modal-body">
                        <h6 class="text-semibold">Upgrade Brand Boost Membership Plan</h6>

                        <table class="table table-hover table-striped table-bordered text-left mb-20">
                            <tr>
                                <td>Name :</td>
                                <td>
                                    {{ oUser.firstname +' ' + oUser.lastname }}
                                </td>
                            </tr>
                            <tr>
                                <td>Email :</td>
                                <td>
                                    {{ oUser.email }}
                                </td>
                            </tr>
                            <tr>
                                <td>Phone :</td>
                                <td>
                                    {{ oUser.mobile }}
                                </td>
                            </tr>
                            <tr>
                                <td>Current Plan :</td>
                                <td>
                                    <template v-if="buyCredits.currentPlanName === 'topup-membership-a'">Topup Membership A</template>
                                    <template v-else-if="buyCredits.currentPlanName === 'topup-membership-b'">Topup Membership B</template>
                                    <template v-else-if="buyCredits.currentPlanName === 'topup-membership-c'">Topup Membership C</template>
                                </td>
                            </tr>
                            <tr>
                                <td>Upgrade to :</td>
                                <td>
                                    <span id="upgradedTopupPlanTitle">
                                        <template v-if="buyCredits.planID === 'topup-membership-a'">Topup Membership A</template>
                                        <template v-else-if="buyCredits.planID === 'topup-membership-b'">Topup Membership B</template>
                                        <template v-else-if="buyCredits.planID === 'topup-membership-c'">Topup Membership C</template>
                                    </span>
                                </td>
                            </tr>
                        </table>
                        <div class="checkbox">
                            <label>
                                <div class="border-primary-600 text-primary-800">
                                    <input class="control-primary" v-model="buyCredits.acceptTerms" type="checkbox">
                                    I accept terms & condition
                                </div>
                                <span style="color:red;">{{buyCredits.selectTerms}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                        <button type="button" class="btn btn-primary"  @click="confirmTopupLevelUpdate()">Yes, Upgrade Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buy Addon plan Modal Confirm -->
        <div id="confirm_buy_addon_plan" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Confirm Buy</h5>
                    </div>

                    <div class="modal-body">
                        <h6 class="text-semibold">Buy Brand Boost addon credits</h6>
                        <table class="table table-hover table-striped table-bordered text-left mb-20">
                            <tr>
                                <td>Name :</td>
                                <td>
                                    {{ oUser.firstname + ' ' + oUser.lastname }}
                                </td>
                            </tr>
                            <tr>
                                <td>Email :</td>
                                <td>
                                    {{ oUser.email }}
                                </td>
                            </tr>
                            <tr>
                                <td>Phone :</td>
                                <td>
                                    {{ oUser.mobile }}
                                </td>
                            </tr>

                            <tr>
                                <td>Addon Pack :</td>
                                <td>
                            <span id="addonpackname">
                                    ${{buyCredits.planName}}
                            </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Price :</td>
                                <td>
                            <span id="addonpackprice">
                                    ${{buyCredits.price}}
                            </span>
                                </td>
                            </tr>
                        </table>
                        <div class="checkbox">
                            <label>
                                <div class="border-primary-600 text-primary-800">
                                    <input class="control-primary" v-model="buyCredits.acceptTerms" type="checkbox">
                                    I accept terms & condition
                                </div>
                                <span style="color:red;">{{buyCredits.selectTerms}}</span>
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="hidLevelTopupPlanId" id="hidAddonPlanId" value=""/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                        <button type="button" id="confirmAddOnBuy" class="btn btn-primary" @click="confirmbuyCreditAddons()">Yes, Buy Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buy Addon plan Modal Confirm -->
        <div id="confirm_buy_custom_addon_plan" class="modal fade">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Confirm Buy</h5>
                    </div>

                    <div class="modal-body">
                        <h6 class="text-semibold">Buy Brand Boost addons credits</h6>
                        <table class="table table-hover table-striped table-bordered text-left mb-20">
                            <tr>
                                <td>Name :</td>
                                <td>
                                    {{ oUser.firstname + ' ' + oUser.lastname }}
                                </td>
                            </tr>
                            <tr>
                                <td>Email :</td>
                                <td>
                                    {{ oUser.email }}
                                </td>
                            </tr>
                            <tr>
                                <td>Phone :</td>
                                <td>
                                    {{ oUser.mobile }}
                                </td>
                            </tr>
                            <tr>
                                <td>Credits Quantity :</td>
                                <td>
                            <span id="customcreditqty">
                                    {{buyCredits.quantity}}
                            </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Price :</td>
                                <td>
                            <span id="customcreditprice">
                                    ${{buyCredits.price}}
                            </span>
                                </td>
                            </tr>
                        </table>

                        <div class="checkbox">
                            <label>
                                <div class="border-primary-600 text-primary-800">
                                    <input class="control-primary" v-model="buyCredits.acceptTerms" type="checkbox">
                                    I accept terms & condition
                                </div>
                                <span style="color:red;">{{buyCredits.selectTerms}}</span>
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="hidLevelTopupPlanId" id="hidCustomAddonPlanId" value="custom-pack"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                        <button type="button" id="confirmCustomAddOnBuy" class="btn btn-primary" @click="confirmCustomAddOnBuy()">Yes, Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        title: 'Admin Settings - Brand Boost',
        name: "SettingSubscription",
        data() {
            return {


                loading: true,
                breadcrumb: '',
                seletedTab: 1,
                settingsData: '',
                notificationData: '',
                oImportHistory: '',
                oExportHistory: '',
                oMemberships: '',
                oCurrentPlanData: '',
                oCurrentTopupPlanData: '',
                oInvoices: '',
                notificationlisting: '',
                oUser: '',
                countries: '',
                credits: {
                    acceptTerms:false,
                    quantity :0,
                    price :0,
                    planID:'',
                    planName:'',
                    currentPlanName:'',
                    selectTerms:'',
                },
                buyCredits: {
                    acceptTerms:false,
                    quantity :0,
                    price :0,
                    planID:'',
                    planName:'',
                    currentPlanName:'',
                    selectTerms:'',
                }
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
                this.showLoading(true);
                axios.get('/admin/settings',{
                        params: {
                            current_tab:'notification'
                        }
                    })
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
            },
            dispUpgradePlan: function (painType){
                this.oCurrentPlanData.subs_cycle= painType
            },

            confirmManualUpgrade:function(planID,planName,currentPlanName){
                this.buyCredits.acceptTerms=false;
                // this.buyCredits.quantity =quantity;
                // this.buyCredits.price =price;
                this.buyCredits.planID =planID;
                this.buyCredits.planName =planName;
                this.buyCredits.currentPlanName =currentPlanName;
            },
            confirmLevelUpgrade: function (){
                this.showLoading(true);
                if(this.buyCredits.acceptTerms) {
                    axios.post('/payment/upgradeMembership', {
                        plan_id: this.buyCredits.planID,
                    })
                        .then(response => {
                            // $bvModal.hide('confirm_topup_level_upgrade')
                            this.buyCredits.acceptTerms =false;
                            this.showLoading(false);
                            this.loadData();
                            $('#confirm_level_upgrade').modal('hide');
                        });
                }else{
                    this.buyCredits.selectTerms ="Please select accept terms & condition."
                }
            },
            confirmTopupUpgradePopup:function(quantity,price,planID,planName,currentPlanName){
                this.buyCredits.acceptTerms=false;
                this.buyCredits.quantity =quantity;
                this.buyCredits.price =price;
                this.buyCredits.planID =planID;
                this.buyCredits.planName =planName;
                this.buyCredits.currentPlanName =currentPlanName;
            },
            confirmTopupLevelUpdate: function (){
                this.showLoading(true);
                if(this.buyCredits.acceptTerms) {
                    axios.post('/payment/upgradeTopupMembership', {
                        toup_plan_id: this.buyCredits.planID,
                    })
                        .then(response => {
                            // $bvModal.hide('confirm_topup_level_upgrade')
                            this.buyCredits.acceptTerms =false;
                            this.showLoading(false);
                            this.loadData();
                            $('#confirm_topup_level_upgrade').modal('hide');
                        });
                }else{
                    this.buyCredits.selectTerms ="Please select accept terms & condition."
                }
            },
            confirmBuyCustomAddonPopup: function(quantity,price,planID,planName){
                this.buyCredits.acceptTerms=false;
                this.buyCredits.quantity =quantity;
                this.buyCredits.price =price;
                this.buyCredits.planID =planID;
                this.buyCredits.planName =planName;
            },
            confirmbuyCreditAddons: function (){
                this.showLoading(true);
                if(this.buyCredits.acceptTerms) {
                    axios.post('/payment/buyCreditAddons', {
                        toup_plan_id: this.buyCredits.planID,
                    })
                        .then(response => {
                            this.buyCredits.acceptTerms =false;
                            this.showLoading(false);
                            this.loadData();
                            $('#confirm_buy_addon_plan').modal('hide');
                        });
                }else{
                    this.buyCredits.selectTerms ="Please select accept terms & condition."
                }
            },
            confirmCustomAddOnBuy: function (){payment/buyCreditAddons
                this.showLoading(true);
                var planID ='custom-pack'
                var qty ='1000';
                if(this.buyCredits.acceptTerms) {
                    axios.post('/payment/buyCreditAddons', {
                        toup_plan_id: this.buyCredits.planID,
                        quantity: this.buyCredits.quantity
                    })
                        .then(response => {
                            this.buyCredits.acceptTerms =false;
                            this.showLoading(false);
                            this.loadData();
                            $('#confirm_buy_custom_addon_plan').modal('hide');
                        });
                }else{
                    this.buyCredits.selectTerms ="Please select accept terms & condition."
                }
            },
            saveGeneralPreferences: function () {
                this.showLoading(true);
                axios.post('/admin/settings/saveGeneralPreferences',{
                    language:this.oUser.language,
                    currency:this.oUser.currency,
                    timezone:this.oUser.timezone,
                    date_format:this.oUser.date_format,
                    time_format:this.oUser.time_format,
                    wh_start_week:this.oUser.wh_start_week,
                    wh_start_day:this.oUser.wh_start_day,
                    wh_start_day_minutes:this.oUser.wh_start_day_minutes,
                    wh_end_day:this.oUser.wh_end_day,
                    wh_end_day_minutes:this.oUser.wh_end_day_minutes,
                })
                    .then(response => {
                        //console.log(response.data);
                        this.showLoading(false);
                        this.loadData();
                    });
            },
            saveFieldsSettings: function () {
                this.showLoading(false);
                axios.post('/admin/settings/saveFieldsSettings',{
                    reviewer_alias:this.oUser.reviewer_alias,
                    seller_alias:this.oUser.seller_alias,
                    review_alias:this.oUser.review_alias,
                })
                    .then(response => {
                        this.showLoading(false);
                        this.loadData();
                    });
            },
        }
    }
    function loadJQCode(){
        $(document).ready(function () {
            // $(".token-field").on('tokenfield:createdtoken tokenfield:removedtoken change', function (e) {
            //     if($(this).parent().children().hasClass('token')) {
            //         $(this).parent().find('.token-input').attr('placeholder', '');
            //     }
            //     else {
            //         $(this).parent().find('.token-input').attr('placeholder', '- Tokenfield');
            //     }
            // }).trigger('change');
            //
            // $('.showSubPage').click(function(){
            //     $('.nav-tabs a[href="#right-icon-tab2"]').tab('show');
            // });
            //
            //
            // $('.changeBA1').click(function(){
            //     $('.changeBA1').removeClass('txt_purple');
            //     $(this).addClass('txt_purple');
            // });
            //
            // $('.changeBA2').click(function(){
            //     $('.changeBA2').removeClass('txt_purple');
            //     $(this).addClass('txt_purple');
            // });
            //
            // $('#public_publish_page').change(function () {
            //     if ($(this).is(":checked") == true) {
            //         $('input[name="public_publish_page"]').attr("value", 1);
            //     } else {
            //         $('input[name="public_publish_page"]').attr("value", 0);
            //     }
            // });
            //
            // $('#business_address_dppa').change(function () {
            //     if ($(this).is(":checked") == true) {
            //         $('input[name="business_address_dppa"]').attr("value", 1);
            //     } else {
            //         $('input[name="business_address_dppa"]').attr("value", 0);
            //     }
            // });
            //
            // $('#phone_no_dppa').change(function () {
            //     if ($(this).is(":checked") == true) {
            //         $('input[name="phone_no_dppa"]').attr("value", 1);
            //     } else {
            //         $('input[name="phone_no_dppa"]').attr("value", 0);
            //     }
            // });
            //
            // $('#website_dppa').change(function () {
            //     if ($(this).is(":checked") == true) {
            //         $('input[name="website_dppa"]').attr("value", 1);
            //     } else {
            //         $('input[name="website_dppa"]').attr("value", 0);
            //     }
            // });
            //

            // Dropzone.autoDiscover = false;
            // var settingUserId = $("#settingsUserId").val();
            // var myDropzone = new Dropzone(
            //     '#myDropzone', //id of drop zone element 1
            //     {
            //         url: '/webchat/dropzone/upload_s3_attachment/'+settingUserId+'/onsite',
            //         uploadMultiple: false,
            //         maxFiles: 1,
            //         maxFilesize: 600,
            //         acceptedFiles: 'image/*',
            //         addRemoveLinks: false,
            //         success: function (response) {
            //
            //             if(response.xhr.responseText != "") {
            //
            //                 $('#brand_logo_image_preview').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
            //                 var dropImage = $('#company_logo').val();
            //                 $.ajax({
            //                     url: 'admin/brandboost/deleteObjectFromS3',
            //                     headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            //                     type: "POST",
            //                     data: {dropImage: dropImage},
            //                     dataType: "json",
            //                     success: function (data) {
            //                         console.log(data);
            //                     }
            //                 });
            //
            //                 $('#company_logo').val(response.xhr.responseText);
            //                 $('.saveUserOtherInfo').trigger('click');
            //             }
            //         }
            //     });

            // myDropzone.on("complete", function(file) {
            //     myDropzone.removeFile(file);
            // });
        });

    }
</script>

<style scoped>

</style>

