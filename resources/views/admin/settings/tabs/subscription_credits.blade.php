<div class="tab-pane <?php if ($seletedTab == 'subs'): ?>active<?php endif; ?>" id="right-icon-tab2">
    <div class="row"> 
        <div class="col-md-9">
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Subscription</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p0">


                    <!--====GENERAL SETTINGS====-->
                    <div class="bbot p30">
                        <div class="row" style="margin-bottom:60px !important;">
                            <div class="col-xs-9">
                                <p class="m0"><strong class="fsize16">Account Plans</strong><br>
                                    <span class="text-muted fsize13">Pick an account plan that fits your workflow. Add a credits<br>
                                        plan to any project when it's ready to go live.</span>
                                </p>
                            </div>
                            <div class="col-xs-3">
                                <p class="pull-left mt-5 text-muted fsize13 mr-20">Billing Type:</p>
                                <div class="btn-group display-inline-block">
                                    <button id="grid" type="button" class="btn btn-xs btn-default dispUpgradePlan" data-cycle="yearly">Annual</button>
                                    <button id="list" type="button" class="btn btn-xs btn-default dispUpgradePlan" data-cycle="monthly">Monthly</button>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        @include('admin.modals.upgrade.partial.plan_list')

                    </div>

                    <div class="p30">
                        <div class="row">
                            <div class="col-xs-9"><p class="m0">All plans come with basic Brand Boost features</p></div>
                            <div class="col-xs-3"><a class="txt_purple" href="#">Explore all features</a></div>
                        </div>
                    </div>



                </div>
            </div>


            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Brand Boost Credits</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
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


                        <div class="row mt40">
                            <?php if (!empty($oMemberships)): ?>
                                <?php foreach ($oMemberships as $oMembership): ?>
                                    <?php
                                    if ($oMembership->type == 'topup-membership'):

                                        if ($oMembership->plan_id == $oUser->topup_plan_id) {
                                            $oCurrentTopupMembership = $oMembership;
                                        }
                                        ?>

                                        <div class="col-xs-4" style="margin-top:20px;">
                                            <div class="price_plan">
                                                <div class="imgicon"><img src="<?php echo base_url(); ?>assets/images/icon_credit.png"/></div>
                                                <div class="bbot p30 text-center">
                                                    <p class="txt_purple fsize16"><?php echo number_format($oMembership->credits); ?> credits</p>	
                                                    <h3>$<?php echo $oMembership->price; ?><span>/<?php
                                                            if ($oMembership->subs_cycle == 'week') {
                                                                echo 'week';
                                                            } elseif ($oMembership->subs_cycle == 'month') {
                                                                echo 'Mo';
                                                            } else if ($oMembership->subs_cycle == 'year') {
                                                                echo 'Yr';
                                                            }
                                                            ?></span></h3>
                                                    <p class="text-muted fsize13 m0">Billed <?php
                                                        if ($oMembership->subs_cycle == 'week') {
                                                            echo 'Weekly';
                                                        } elseif ($oMembership->subs_cycle == 'month') {
                                                            echo 'Monthly';
                                                        } else if ($oMembership->subs_cycle == 'year') {
                                                            echo 'Yearly';
                                                        }
                                                        ?></p>
                                                </div>


                                                <div class="p30">
                                                    <?php
                                                    if ($oUser->topup_plan_id == $oMembership->plan_id) {
                                                        $isTopupMembershipActive = true;
                                                        ?>
                                                        <button type="button" class="btn white_btn w100 h40 txt_purple"><span>Active</span> </button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn dark_btn w100 bkg_purple h40 confirmTopupUpgrade" topup_plan_name="<?php echo $oMembership->level_name; ?>" topup_plan_id="<?php echo $oMembership->plan_id; ?>" data-toggle="modal" data-target="#confirm_topup_level_upgrade"><span><?php if (empty($isTopupMembershipActive)): ?>Buy<?php elseif ($isTopupMembershipActive): ?>Upgrade<?php else: ?>Downgrade<?php endif; ?></span> </button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div> 

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>



                    </div>


                </div>
            </div>


            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Addon Credits</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
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


                        <div class="row mt40">
                            <?php if (!empty($oMemberships)): ?>
                                <?php foreach ($oMemberships as $oMembership): ?>
                                    <?php
                                    if ($oMembership->type == 'topup' && $oMembership->level_name != 'Custom Pack'):
                                        ?>

                                        <div class="col-xs-4" style="margin-top:20px;">
                                            <div class="price_plan">
                                                <div class="imgicon"><img src="<?php echo base_url(); ?>assets/images/icon_credit.png"/></div>
                                                <div class="bbot p30 text-center">
                                                    <p><strong><?php echo $oMembership->level_name; ?></strong></p>
                                                    <p class="txt_purple fsize16"><?php echo number_format($oMembership->credits); ?> credits</p>	
                                                    <h3>$<?php echo $oMembership->price; ?><span></span></h3>
                                                    <p class="text-muted fsize13 m0">Flat Fee</p>
                                                </div>


                                                <div class="p30">
                                                    <button type="button" class="btn dark_btn w100 bkg_purple h40 confirmBuyAddon" topup_plan_name="<?php echo $oMembership->level_name; ?>" topup_plan_id="<?php echo $oMembership->plan_id; ?>" topup_plan_price="<?php echo $oMembership->price; ?>" data-toggle="modal" data-target="#confirm_buy_addon_plan"><span>Buy</span> </button>
                                                </div>
                                            </div>
                                        </div> 

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>



                    </div>
                    <?php if (!empty($oMemberships)): ?>
                        <?php foreach ($oMemberships as $oMembership): ?>
                            <?php
                            $unitprice = 0;
                            if ($oMembership->type == 'topup' && $oMembership->level_name == 'Custom Pack'):
                                $unitprice = $oMembership->price;
                                ?>
                                <div class="p30">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <p class="m0"><strong class="fsize16">Buy Additional Brand Boost Credits</strong><br>
                                                <span class="text-muted fsize13">All projects on your plan come with Staging. </span>
                                            </p>
                                        </div>

                                        <div class="col-xs-2">
                                            <p class="fsize13">Credits</p>
                                            <div class="input-group input-group-xlg pull-left">
                                                <input class="form-control" value="1000" name="txtCustomQty"id="txtCustomQty" type="text" title="Enter quantity of credits" placeholder="1000">
                                                <span class="input-group-addon" id="customprice">$<?php echo ($oMembership->price * 1000); ?></span>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <p class="fsize13">&nbsp;</p>
                                            <button type="button" class="btn dark_btn w100 bkg_purple h40 confirmBuyCustomAddon" topup_plan_name="<?php echo $oMembership->level_name; ?>" topup_plan_id="<?php echo $oMembership->plan_id; ?>" topup_plan_price="<?php echo $oMembership->price; ?>" data-toggle="modal" data-target="#confirm_buy_custom_addon_plan"  class="btn dark_btn"><span>Buy</span> </button>
                                        </div>

                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>


                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Info Card</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body min_h405 p40 pt60 info_card text-center">
                    <div class="img_icon mb20"><img src="<?php echo base_url(); ?>assets/images/icon_credit.png" width="35"></div>
                    <p class="mb20"><strong>Learn more about Brand Boost Credits</strong></p>
                    <p class="mb20"><span>Being the savage's bowsman, that <br>is, the person who pulled.</span></p>
                    <a class="txt_purple" href="#">Learn More</a>
                </div>
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
                            <?php echo $oUser->firstname . ' ' . $oUser->lastname ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td>
                            <?php echo $oUser->email; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone :</td>
                        <td>
                            <?php echo $oUser->mobile; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Current Plan :</td>
                        <td>
                            <?php echo!empty($oCurrentTopupMembership->level_name) ? $oCurrentTopupMembership->level_name : 'No topup plan subscribed yet'; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Upgrade to :</td>
                        <td>
                            <span id="upgradedTopupPlanTitle">

                            </span>
                        </td>
                    </tr>
                </table>


                <div class="checkbox">
                    <label>
                        <div class="border-primary-600 text-primary-800"><input class="control-primary" id="topuplvltermsCondition" type="checkbox">
                        </div>
                        I accept terms & condition
                    </label>
                </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" name="hidLevelTopupPlanId" id="hidLevelTopupPlanId" value=""/>
                <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                <button type="button" id="confirmTopupLevelUpdate" class="btn btn-primary">Yes, Upgrade Now</button>
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
                            <?php echo $oUser->firstname . ' ' . $oUser->lastname ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td>
                            <?php echo $oUser->email; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone :</td>
                        <td>
                            <?php echo $oUser->mobile; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Addon Pack :</td>
                        <td>
                            <span id="addonpackname">

                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Price :</td>
                        <td>
                            <span id="addonpackprice">

                            </span>
                        </td>
                    </tr>
                </table>


                <div class="checkbox">
                    <label>
                        <div class="border-primary-600 text-primary-800"><input class="control-primary" id="addontermsCondition" type="checkbox">
                        </div>
                        I accept terms & condition
                    </label>
                </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" name="hidLevelTopupPlanId" id="hidAddonPlanId" value=""/>
                <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                <button type="button" id="confirmAddOnBuy" class="btn btn-primary">Yes, Buy Now</button>
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
                            <?php echo $oUser->firstname . ' ' . $oUser->lastname ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td>
                            <?php echo $oUser->email; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone :</td>
                        <td>
                            <?php echo $oUser->mobile; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Credits Quantity :</td>
                        <td>
                            <span id="customcreditqty">

                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Price :</td>
                        <td>
                            <span id="customcreditprice">

                            </span>
                        </td>
                    </tr>
                </table>


                <div class="checkbox">
                    <label>
                        <div class="border-primary-600 text-primary-800"><input class="control-primary" id="addoncustomtermsCondition" type="checkbox">
                        </div>
                        I accept terms & condition
                    </label>
                </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" name="hidLevelTopupPlanId" id="hidCustomAddonPlanId" value=""/>
                <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                <button type="button" id="confirmCustomAddOnBuy" class="btn btn-primary">Yes, Buy Now</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        $("#txtCustomQty").keyup(function () {
            var creditsQty = $(this).val();
            var unitPrice = '<?php echo $unitprice; ?>';
            var totalCost = unitPrice * creditsQty;
            $("#customprice").html('$' + totalCost);
        });
        $(".billcycleType").click(function () {
            var billtype = $(this).attr("data-cycle");
            if (billtype == 'monthly') {
                $("#monthly_pricing").show();
                $("#yearly_pricing").hide();
            }

            if (billtype == 'yearly') {
                $("#yearly_pricing").show();
                $("#monthly_pricing").hide();
            }
        });

        $(".confirmBuyCustomAddon").click(function () {
            var planName = $(this).attr('topup_plan_name');
            var planID = $(this).attr('topup_plan_id');
            var planPrice = $(this).attr('topup_plan_price');
            var creditQty = $("#txtCustomQty").val();

            $("#customcreditqty").text(creditQty);
            $("#customcreditprice").text('$' + planPrice * creditQty);

            $("#hidCustomAddonPlanId").val(planID);
        });

        $(".confirmBuyAddon").click(function () {
            var planName = $(this).attr('topup_plan_name');
            var planID = $(this).attr('topup_plan_id');
            var planPrice = $(this).attr('topup_plan_price');

            $("#addonpackname").text(planName);
            $("#addonpackprice").text('$' + planPrice);

            $("#hidAddonPlanId").val(planID);
        });

        $(".confirmTopupUpgrade").click(function () {
            var planName = $(this).attr('topup_plan_name');
            var planID = $(this).attr('topup_plan_id');

            $("#upgradedTopupPlanTitle").text(planName);
            $("#hidLevelTopupPlanId").val(planID);
        });

        $("#confirmTopupLevelUpdate").click(function () {
            $(this).attr('disabled', 'disabled');
            var elem = $(this);
            $('.overlaynew').show();
            var hidPlanID = $("#hidLevelTopupPlanId").val();
            if ($('#topuplvltermsCondition').is(":checked") == true) {
                $.ajax({
                    url: "<?php echo base_url('payment/upgradeTopupMembership'); ?>",
                    type: "POST",
                    data: {
                        _token: '{{csrf_token()}}', toup_plan_id: hidPlanID
                    },
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            alertMessageAndRedirect(data.msg, window.location.href);


                        } else {
                            $(elem).removeAttr('disabled');
                            alertMessage(data.msg);
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $(elem).removeAttr('disabled');
                alertMessage('Please accept terms and condition.');
                $('.overlaynew').hide();
            }
        });

        $("#confirmAddOnBuy").click(function () {
            $(this).attr('disabled', 'disabled');
            var elem = $(this);
            $('.overlaynew').show();
            var hidPlanID = $("#hidAddonPlanId").val();
            if ($('#addontermsCondition').is(":checked") == true) {
                $.ajax({
                    url: "<?php echo base_url('payment/buyCreditAddons'); ?>",
                    type: "POST",
                    data: {
                        _token: '{{csrf_token()}}', toup_plan_id: hidPlanID
                    },
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            alertMessageAndRedirect(data.msg, window.location.href);


                        } else {
                            $(elem).removeAttr('disabled');
                            alertMessage(data.msg);
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $(elem).removeAttr('disabled');
                alertMessage('Please accept terms and condition.');
                $('.overlaynew').hide();
            }
        });

        $("#confirmCustomAddOnBuy").click(function () {
            var elem = $(this);
            $(this).attr('disabled', 'disabled');
            $('.overlaynew').show();
            var hidPlanID = $("#hidCustomAddonPlanId").val();
            var qty = $("#txtCustomQty").val();
            if ($('#addoncustomtermsCondition').is(":checked") == true) {
                $.ajax({
                    url: "<?php echo base_url('payment/buyCreditAddons'); ?>",
                    type: "POST",
                    data: {
                        _token: '{{csrf_token()}}', 
                        toup_plan_id: hidPlanID,
                        quantity: qty
                    },
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            alertMessageAndRedirect(data.msg, window.location.href);


                        } else {
                            $(elem).removeAttr('disabled');
                            alertMessage(data.msg);
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $(elem).removeAttr('disabled');
                alertMessage('Please accept terms and condition.');
                $('.overlaynew').hide();
            }
        });

    });
</script>