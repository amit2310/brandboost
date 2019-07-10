<div id="upgrade_popup2" class="modal fade">
    <div style="width: 100%; max-width: 950px!important;" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header purple_preview_2">
                <div class="monthly_btn">
                    <a href="javascript:void(0);" class="dispUpgradePlan" data-cycle="yearly">Annual</a>
                    <a href="javascript:void(0);" class="month_btn dispUpgradePlan" data-cycle="monthly">Monthly</a>
                </div>
                <h5 class="modal-title"><img src="{{ URL::asset('assets/images/upgrade_icon.png') }}">Upgrade your subscription<span>Pick an account plan that fits your workflow. Add a credits<br> plan to any project when it's ready to go live.</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body pricing_modal pb30 pt60">
                @include('admin.modals.upgrade.partial.plan_list')
            </div>
            <div class="modal-footer pt-20">
                <div class="row">
                    <div class="col-md-12 text-center"> <img src="{{ URL::asset('assets/images/moneybackgurantee2.jpg') }}" /> </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="upgrade_popup1" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upgrade to <?php echo $oSuggestedPlan->level_name; ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>


            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center mb-20">
                        <h2 class="modal-title">Empower your team with these additional features:</h2>
                    </div>

                    <div class="col-md-6 text-center mt-20"><img class="img-responsive" src="<?php echo base_url(); ?>assets/images/upgrade1.jpg"/> </div>
                    <div class="col-md-6 mt-20">
                        <div class="content-group">
                            <dl>
                                
                                
                                <dt class="text-size-small text-bold text-uppercase">
                                    <i class="icon-checkmark3 text-blue position-left"></i>
                                    Credits                                 </dt>

                                <dd>Total Credits :
                                    <?php echo $oSuggestedPlan->credits; ?>
                                </dd>
                                
                                <dt class="text-size-small text-bold text-uppercase">
                                    <i class="icon-checkmark3 text-blue position-left"></i>
                                    Contacts                                 </dt>

                                <dd>
                                    Save upto <?php echo $oSuggestedPlan->contact_limit; ?> contacts
                                </dd>
                                
                                <dt class="text-size-small text-bold text-uppercase">
                                    <i class="icon-checkmark3 text-blue position-left"></i>
                                    Reviews App
                                </dt>

                                <dd>Get onsite offsite reviews by creating email/sms campaigns</dd>

                                <dt class="text-size-small text-bold text-uppercase">
                                    <i class="icon-checkmark3 text-blue position-left"></i>
                                    Chat App
                                </dt>

                                <dd>Get unlimited access to chat with your contacts</dd>
                                
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-20">
                <div class="row">
                    <div class="col-md-9 text-left">
                        <h1 style="margin: 0;">For an additional <strong>$<?php echo $additionalPriceToPay; ?></strong> every month,</h1>
                        <h4 style="margin: 0 0 10px;">You can get brandboost.io most popular plan</h4>
                        <p class="mb0">Want to get up to a 32% discount? <a data-toggle="modal" data-target="#upgrade_popup2" href="#">explore more plans</a> </p>
                    </div>
                    <div class="col-md-3 pt-20 text-center">
                        <button type="button" class="btn dark_btn mb-10" id="btnLevelUpgrade" plan_name="<?php echo $oSuggestedPlan->level_name; ?>" plan_id="<?php echo $oSuggestedPlan->plan_id; ?>" data-toggle="modal" data-target="#confirm_level_upgrade">Confirm Upgrade</button>
                        <p>Your Card will be automatically charged</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>