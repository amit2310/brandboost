<?php error_reporting(0);//pre($oCurrentPlanData); die;   ?>

<div class="row monthly_pricing_plan" <?php if (!empty($oCurrentPlanData) && !(($oCurrentPlanData->subs_cycle == 'month' || $oCurrentPlanData->subs_cycle == 'monthly') && ($oCurrentPlanData->level_name != 'Pro'))): ?> style="display:none;"<?php endif; ?>> 
    <?php if (!empty($oMemberships)): $isMembershipActive = false; ?>
        <?php foreach ($oMemberships as $oMembership): ?>
            <?php if (($oMembership->type == 'membership') && ($oMembership->subs_cycle == 'monthly' || $oMembership->subs_cycle == 'month')): ?>
                <!-- Pricing -->
                <?php
                if ($oMembership->level_name == 'Starter') {
                    $planiconup = 'starter_icon.png';
                } else if ($oMembership->level_name == 'Business') {
                    $planiconup = 'business_icon.png';
                } else if ($oMembership->level_name == 'Pro') {
                    $planiconup = 'pro_icon.png';
                } else {
                    $planiconup = 'pro_icon.png';
                }
                ?>
                <div class="col-xs-4">
                    <div class="price_plan">
                        <div class="imgicon"><img src="{{ URL::asset('assets/images/'.$planiconup) }}"/></div>
                        <div class="bbot p30 text-center">
                            <p class="txt_purple fsize16 mt-5"><?php echo $oMembership->level_name; ?></p>	
                            <h3 class="mt-5 mb0">$<?php echo $oMembership->price; ?><span>/mo</span></h3>
                            <p class="text-muted fsize13 m0">Billed Monthly</p>
                        </div>

                        <div class="bbot p20 text-center">
                            <p class="text-muted fsize12 m0">A light plan that lets you export your<br> code for use in other environments<br> or build prototypes.</p>
                        </div>
                        <div class="p30 pt20 pb20">
                            <ul class="mb20">
                                <li><i class="icon-checkmark-circle"></i> <?php echo number_format($oMembership->credits); ?> Credits</li>
                                <li><i class="icon-checkmark-circle"></i> <?php echo number_format($oMembership->contact_limit); ?> Contacts</li>
                                <li><i class="icon-checkmark-circle"></i> Reviews App</li>
                                <li><i class="icon-checkmark-circle"></i> Chat App</li>
                                <li <?php if ($oMembership->level_name != 'Pro' && $oMembership->level_name != 'Business'): ?> class="disabled"<?php endif; ?>><i class="<?php if ($oMembership->level_name != 'Pro' && $oMembership->level_name != 'Business'): ?>icon-cancel-circle2<?php else: ?>icon-checkmark-circle<?php endif; ?>"></i> On Site widgets</li>
                                <li <?php if ($oMembership->level_name != 'Pro' && $oMembership->level_name != 'Business'): ?> class="disabled"<?php endif; ?>><i class="<?php if ($oMembership->level_name != 'Pro' && $oMembership->level_name != 'Business'): ?>icon-cancel-circle2<?php else: ?>icon-checkmark-circle<?php endif; ?>"></i> Automation/Broadcast App</li>
                                <li <?php if ($oMembership->level_name != 'Pro'): ?> class="disabled"<?php endif; ?>><i class="<?php if ($oMembership->level_name != 'Pro'): ?>icon-cancel-circle2<?php else: ?>icon-checkmark-circle<?php endif; ?>"></i> NPS App</li>
                                <li <?php if ($oMembership->level_name != 'Pro'): ?> class="disabled"<?php endif; ?>><i class="<?php if ($oMembership->level_name != 'Pro'): ?>icon-cancel-circle2<?php else: ?>icon-checkmark-circle<?php endif; ?>"></i> Referral App</li>
                                <li <?php if ($oMembership->level_name != 'Pro'): ?> class="disabled"<?php endif; ?>><i class="<?php if ($oMembership->level_name != 'Pro'): ?>icon-cancel-circle2<?php else: ?>icon-checkmark-circle<?php endif; ?>"></i> Analytics</li>
                            </ul>
                            <?php
                            if(isset($oUser->plan_id) && isset($oMembership->plan_id) )
                            {
                            if ($oUser->plan_id == $oMembership->plan_id) {
                                  $isMembershipActive = true;
                                ?>
                                <button type="button" class="btn white_btn w100 h40 txt_purple"><span>Active</span> </button>
                            <?php } else { ?>
                                <button type="button" type="button" class="btn dark_btn w100 bkg_purple h40 confirmManualUpgrade" plan_id="<?php echo $oMembership->plan_id; ?>" plan_name="<?php echo $oMembership->level_name; ?>"><span><?php if (empty($oCurrentPlanData)): ?>Buy<?php elseif ($isMembershipActive): ?>Upgrade<?php else: ?>Downgrade<?php endif; ?></span> </button>
                            <?php } 
                            }
                        ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <!--//End Pricing --> 
</div>

<div class="row yearly_pricing_plan" <?php if (!(($oCurrentPlanData->subs_cycle == 'yearly' || $oCurrentPlanData->subs_cycle == 'year') || ($oCurrentPlanData->level_name == 'Pro'))): ?> style="display:none;"<?php endif; ?>> 
    <?php if (!empty($oMemberships)): $isMembershipActive = false; ?>
        <?php foreach ($oMemberships as $oMembership): ?>
            <?php if (($oMembership->type == 'membership') && ($oMembership->subs_cycle == 'yearly' || $oMembership->subs_cycle == 'year')): ?>
                <!-- Pricing -->
                <?php
                if ($oMembership->level_name == 'Starter Yearly') {
                    $planiconup2 = 'starter_icon.png';
                } else if ($oMembership->level_name == 'Business Yearly') {
                    $planiconup2 = 'business_icon.png';
                } else if ($oMembership->level_name == 'Pro Yearly') {
                    $planiconup2 = 'pro_icon.png';
                } else {
                    $planiconup2 = 'pro_icon.png';
                }
                ?>
                <div class="col-xs-4">
                    <div class="price_plan">
                        <div class="imgicon"><img src="{{ URL::asset('assets/images/'.$planiconup2) }}"/></div>
                        <div class="bbot p30 text-center">
                            <p class="txt_purple fsize16 mt-5"><?php echo $oMembership->level_name; ?></p>	
                            <h3 class="mt-5 mb0">$<?php echo $oMembership->price; ?><span>/yr</span></h3>
                            <p class="text-muted fsize13 m0">Billed Yearly</p>
                        </div>

                        <div class="bbot p20 text-center">
                            <p class="text-muted fsize12 m0">A light plan that lets you export your<br> code for use in other environments<br> or build prototypes.</p>
                        </div>
                        <div class="p30 pt20 pb20">
                            <ul class="mb20">
                                <li><i class="icon-checkmark-circle"></i> <?php echo number_format($oMembership->credits); ?> Credits</li>
                                <li><i class="icon-checkmark-circle"></i> <?php echo number_format($oMembership->contact_limit); ?> Contacts</li>
                                <li><i class="icon-checkmark-circle"></i> Reviews App</li>
                                <li><i class="icon-checkmark-circle"></i> Chat App</li>
                                <li <?php if ($oMembership->level_name != 'Pro Yearly' && $oMembership->level_name != 'Business Yearly'): ?> class="disabled"<?php endif; ?>><i class="<?php if ($oMembership->level_name != 'Pro Yearly' && $oMembership->level_name != 'Business Yearly'): ?>icon-cancel-circle2<?php else: ?>icon-checkmark-circle<?php endif; ?>"></i> On Site widgets</li>
                                <li <?php if ($oMembership->level_name != 'Pro Yearly' && $oMembership->level_name != 'Business Yearly'): ?> class="disabled"<?php endif; ?>><i class="<?php if ($oMembership->level_name != 'Pro Yearly' && $oMembership->level_name != 'Business Yearly'): ?>icon-cancel-circle2<?php else: ?>icon-checkmark-circle<?php endif; ?>"></i> Automation/Broadcast App</li>
                                <li <?php if ($oMembership->level_name != 'Pro Yearly'): ?> class="disabled"<?php endif; ?>><i class="<?php if ($oMembership->level_name != 'Pro Yearly'): ?>icon-cancel-circle2<?php else: ?>icon-checkmark-circle<?php endif; ?>"></i> NPS App</li>
                                <li <?php if ($oMembership->level_name != 'Pro Yearly'): ?> class="disabled"<?php endif; ?>><i class="<?php if ($oMembership->level_name != 'Pro Yearly'): ?>icon-cancel-circle2<?php else: ?>icon-checkmark-circle<?php endif; ?>"></i> Referral App</li>
                                <li <?php if ($oMembership->level_name != 'Pro Yearly'): ?> class="disabled"<?php endif; ?>><i class="<?php if ($oMembership->level_name != 'Pro Yearly'): ?>icon-cancel-circle2<?php else: ?>icon-checkmark-circle<?php endif; ?>"></i> Analytics</li>
                            </ul>
                            <?php
                            if ($oCurrentPlanData->level_name == 'Pro') {
                                $bForceDisplay = true;
                            } else {
                                $bForceDisplay = false;
                            }
                            if ($oUser->plan_id == $oMembership->plan_id) {
                                $isMembershipActive = true;
                                ?>
                                <button type="button" class="btn white_btn w100 txt_purple h40"><span>Active</span> </button>
                            <?php } else { ?>
                                <button type="button" type="button" class="btn dark_btn w100 bkg_purple h40 confirmManualUpgrade" plan_id="<?php echo $oMembership->plan_id; ?>" plan_name="<?php echo $oMembership->level_name; ?>"><span><?php if ($isMembershipActive || $bForceDisplay): ?>Upgrade<?php else: ?>Downgrade<?php endif; ?></span> </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <!--//End Pricing --> 
</div>
<script>
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