@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')

<?php
$oAdvMultipleCoupon = new stdClass();
$oRefMultipleCoupon = new stdClass();
$oAdvMultipleCoupon->expiry = 'never';
$oAdvMultipleCoupon->expiry_specific_date = '';
$oRefMultipleCoupon->coupon_code = '';
$oRefMultipleCoupon->expiry = '';
$oRefMultipleCoupon->expiry_specific_date = '';

if (!empty($oAdvCouponCodes)) {
    foreach ($oAdvCouponCodes as $oCoupon) {
        if ($oCoupon->usage_type == 'single') {
            $aAdvCoupons[] = $oCoupon->coupon_code;
        }

        if ($oCoupon->usage_type == 'multiple') {
            $oAdvMultipleCoupon = $oCoupon;
        }
    }
}


if (!empty($oRefCouponCodes)) {
    foreach ($oRefCouponCodes as $oCoupon) {
        if ($oCoupon->usage_type == 'single') {
            $aRefCoupons[] = $oCoupon->coupon_code;
        }

        if ($oCoupon->usage_type == 'multiple') {
            $oRefMultipleCoupon = $oCoupon;
        }
    }
}
?>
<style type="text/css">
    .panel-referred-heading, .panel-advocate-heading { 
        border: 1px solid #ddd !important;
        box-shadow: none;
        border-radius: 5px;
        line-height: 47px;
        min-height: auto;
    }
</style>
<div class="content">
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3 class="mt30"><img style="width: 16px;" src="<?php echo base_url(); ?>assets/images/refferal_icon.png"> New Referral Campaign</h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                
                <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn publishReferralStatus" status="draft"><i class="icon-plus3"></i><span> &nbsp;  Save as Draft</span> </button>

                <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn publishReferralStatus" status="active"><i class="icon-plus3"></i><span> &nbsp;  Publish</span> </button>

                <!-- <button style="padding: 7px 15px!important;"  type="button" class="btn dark_btn" data-toggle="modal" data-target="#addPeopleList"><i class="icon-plus3 txt_green3"></i></button> -->
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->


    <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->

    <!--==================Broadcasts Menu============-->
    <div class="row">
        <div class="col-md-12">
            <div class="white_box broadcast_menu nps">
                <ul>
                    <li><a href="<?php echo base_url(); ?>admin/modules/referral/setup/<?php echo $moduleUnitID; ?>"><img src="<?php echo base_url(); ?>assets/images/email_br_icon1_grey.png">Select Source</a></li>
                    <li><a class="active" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/sms_br_icon2_act.png">Rewards</a></li>
                    <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/email_br_icon3.png">Email Workflow</a></li>
                    <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/email_br_icon4.png">Configuration</a></li>
                    <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/email_br_icon5.png">Summary</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--==================Broadcasts content============-->
    <div class="select_section" style="max-width: 100%;">

        <!--------------------------Give advocates a free gift------------------------------------->
        <div class="row mt10 mb10">
            <div class="col-md-6">
                <div class="">
                    <p class="fsize16 fw500 txt_dark">Advocates Reward</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-right">
                    <p class="fsize14 fw300 txt_grey">Select gift</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 text-center">
                <label for="temp1" class="m0 advocateGift" option-type="#advocate-discount-new">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input class="checkAdvocateGift" type="radio" name="advocateGiftType" value="coupon" id="temp1" <?php echo $oSettings->adv_coupon_id > 0 ? 'checked' : ''; ?>>
                            <span class="custmo_checkmark green_tr"></span>
                        </label>

                        <div class="img_box img_inactive" style="<?php echo $oSettings->adv_coupon_id > 0 ? 'display: none;' : ''; ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_1.png"/>
                        </div>

                        <div class="img_box img_active" style="<?php echo $oSettings->adv_coupon_id > 0 ? '' : 'display: none;'; ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_1_act.png"/>
                        </div>
                        <p class="fsize14 txt_dark fw500">Coupon</p>
                        <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
                    </div>
                </label>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp2" class="m0 advocateGift" option-type="#advocate-cash-new">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input class="checkAdvocateGift" type="radio" name="advocateGiftType" value="cash" id="temp2" <?php echo $oSettings->cash_id > 0 ? 'checked' : ''; ?>>
                            <span class="custmo_checkmark green_tr"></span>
                        </label>
                        <div class="img_box img_inactive" style="<?php echo $oSettings->cash_id > 0 ? 'display: none;' : ''; ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_2.png"/>
                        </div>
                        <div class="img_box img_active" style="<?php echo $oSettings->cash_id > 0 ? '' : 'display: none;'; ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_2_act.png"/>
                        </div>
                        <p class="fsize14 txt_dark fw500">Cash</p>
                        <p class="fsize12 txt_grey fw300">Cash discount for advocate</p>
                    </div>
                </label>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp3" class="m0 advocateGift" option-type="#advocate-custom-new">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input class="checkAdvocateGift" type="radio" name="advocateGiftType" value="custom" id="temp3" <?php echo $oSettings->custom_id > 0 ? 'checked' : ''; ?>>
                            <span class="custmo_checkmark green_tr"></span>
                        </label>
                        <div class="img_box img_inactive" style="<?php echo $oSettings->custom_id > 0 ? 'display: none;' : ''; ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_3.png"/>
                        </div>
                        <div class="img_box img_active" style="<?php echo $oSettings->custom_id > 0 ? '' : 'display: none;'; ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_3_act.png"/>
                        </div>
                        <p class="fsize14 txt_dark fw500">Custom</p>
                        <p class="fsize12 txt_grey fw300">Custom discount for advocate</p>
                    </div>
                </label>
            </div>
        </div>

        <?php
        if ($oSettings->adv_coupon_id > 0) {
            $display = 'block';
        } else if ($oSettings->cash_id > 0) {
            $display = 'block';
        } else if ($oSettings->custom_id > 0) {
            $display = 'block';
        } else {
            $display = 'none';
        }
        ?>

        <div class="row mt20">
            <div class="col-md-12">
                <div class="white_box p20 pl30 pr30">
                    <div class="row advocateGiftHeading" style="display: <?php echo $display; ?>;">
                        <div class="col-md-12 mb20">
                            <p class="fsize15 bbot pb-15">Gift Configuration</p>
                        </div>
                    </div>

                    <div class="p20 advocateGiftD" style="display: <?php echo $display; ?>;">
                        <div class="row">

                            <div class="advocate_desc" id="advocate-discount-new" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->adv_coupon_id > 0) ? 'display:block;' : 'display:none;' ?>">
                                <form name="frmAdvocateDiscount" id="frmAdvocateDiscount" method="post" data-container-id="advocate-free-gift" >
									{{ csrf_field() }}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Amount</label>
                                            <div class="">
                                                <input type="hidden" name="rewardType" value="advocate_discount" />
                                                <input name="advocate_discount_price" class="form-control" type="text" value="<?php echo (!empty($oSettings->advocate_discount)) ? $oSettings->advocate_discount : ''; ?>" required placeholder="10">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div class="">
                                                <div class="input-group">
													<?php
													if ($oSettings->advocate_discount_type == 'dollar') {
														$dollarCoupon = 'table-cell';
														$percentCoupon = 'none';
														$advDisValue = '$';
													} else if ($oSettings->advocate_discount_type == 'percent') {
														$percentCoupon = 'table-cell';
														$dollarCoupon = 'none';
														$advDisValue = '%';
													} else {
														$dollarCoupon = 'none';
														$percentCoupon = 'table-cell';
														$advDisValue = '%';
													}
													?>
                                                    <input type="hidden" name="advocate_discount_type" class="form-control advocate_discount_type" value="<?php echo (!empty($oSettings->advocate_discount_type)) ? $oSettings->advocate_discount_type : 'percent'; ?>" placeholder="%">
                                                    <input type="text" name="" value="<?php echo $advDisValue; ?>" id="adCouponVal" class="form-control" readonly />
                                                    <span style="display: <?php echo $dollarCoupon; ?>;" class="input-group-addon bkg_dgreen bor_n adCouponType" amtSign="%" amtText="percent"><i class="icon-percent txt_white"></i></span>
                                                    <span style="display: <?php echo $percentCoupon; ?>;" class="input-group-addon bkg_dgreen bor_n adCouponType" amtSign="$" amtText="dollar"><i class="icon-coin-dollar txt_white"></i></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label">Reward Message</label>
                                            <div class="">

                                                <input type="text" name="advocate_discount" class="form-control" value="<?php echo (!empty($oSettings->advocate_display_msg)) ? $oSettings->advocate_display_msg : '20% off'; ?>" placeholder="e.g. 20% off" required="required" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-right hidden">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div>

                                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                                <button type="button" class="btn white_btn"><span>Cancel</span> </button>
                                                <button type="submit" class="btn dark_btn ml20 bkg_dgreen advDiscountSave"><span>Save Changes</span> </button>

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
                                                <input type="radio" name="advCouponCode" option-type="adv_single_use_coupons" <?php if ($oSettings->advocate_coupon_type == 'single'): ?> checked="checked" <?php endif; ?> class="control-primary advocate_options">
                                            </span>
                                            <strong>Single Use Coupons</strong> Unique coupon codes for every advocate 

                                        </label>

                                    </div>
                                    <div class="coupon_desc" id="advocate-single-use_code" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->advocate_coupon_type == 'single') ? 'display:block;' : 'display:none;' ?>">
                                        <form name="frmAdvSingleUseCodes" id="frmAdvSingleUseCodes" data-container-id="advocate-coupon-details" method="post" >
											{{ csrf_field() }}
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="control-label">Paste your coupon codes here</label>
                                                    <div class="">
                                                        <textarea name="singleCouponCodes"  class="form-control"  placeholder="list of coupon codes" required="required" ><?php
                                                    if (!empty($aAdvCoupons)) {
                                                        echo trim(implode(",", $aAdvCoupons));
                                                    }
?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-right hidden">
                                                <div class="form-group">
                                                    <label class="control-label">&nbsp;</label>
                                                    <div>
                                                        <input type="hidden" name="couponType" value="advocate_single_coupons" />
                                                        <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                                        <button type="submit" class="btn dark_btn ml20 bkg_dgreen singleCouponCodesSubmit"><span>Save Changes</span> </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="radio">
                                        <label>
                                            <span>
                                                <input type="radio" name="advCouponCode" option-type="adv_multiple_use_coupons" <?php if ($oSettings->advocate_coupon_type == 'multiple'): ?> checked="checked" <?php endif; ?> class="control-primary advocate_options">
                                            </span>
                                            <strong>Multiple Use Coupons</strong> Reusable coupon code for all advocates 

                                        </label>

                                    </div>
                                    <div class="coupon_desc" id="advocate-multiple-use_code" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->advocate_coupon_type == 'multiple') ? 'display:block;' : 'display:none;' ?>">
                                        <form name="frmAdvMultipleUseCodes" id="frmAdvMultipleUseCodes" data-container-id="advocate-coupon-details" method="post" >
											{{ csrf_field() }}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Paste your coupon code</label>
                                                    <div class="">
                                                        <input type="text" class="form-control" name="multipleCouponCodes" value="<?php //echo ($oAdvMultipleCoupon->coupon_code) ? $oAdvMultipleCoupon->coupon_code : ''; ?>" id="multipleCouponCodes" placeholder="e.g. REWARD10" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Expiry</label>
                                                    <div class="">
                                                        <select class="form-control" id="adv_coupon_expiry" name="coupon_expiry">
                                                            <option value="never" <?php echo ($oAdvMultipleCoupon->expiry == 'never') ? 'selected = "selected"' : ''; ?> >Never(Recommended)</option>
                                                            <option value="6" <?php echo ($oAdvMultipleCoupon->expiry == '6') ? 'selected = "selected"' : ''; ?>>6 Months</option>
                                                            <option value="5" <?php echo ($oAdvMultipleCoupon->expiry == '5') ? 'selected = "selected"' : ''; ?>>5 Months</option>
                                                            <option value="4" <?php echo ($oAdvMultipleCoupon->expiry == '4') ? 'selected = "selected"' : ''; ?>>4 Months</option>
                                                            <option value="3" <?php echo ($oAdvMultipleCoupon->expiry == '3') ? 'selected = "selected"' : ''; ?>>3 Months</option>
                                                            <option value="2" <?php echo ($oAdvMultipleCoupon->expiry == '2') ? 'selected = "selected"' : ''; ?>>2 Months</option>
                                                            <option value="1" <?php echo ($oAdvMultipleCoupon->expiry == '1') ? 'selected = "selected"' : ''; ?>>1 Months</option>
                                                            <option value="specific-date" <?php echo ($oAdvMultipleCoupon->expiry == 'specific-date') ? 'selected = "selected"' : ''; ?>>Specific Date</option>

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">&nbsp;</label>
                                                    <div class="">
                                                        <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="adv_specific_expiry_picker" value="<?php echo ($oAdvMultipleCoupon->expiry_specific_date) ? $oAdvMultipleCoupon->expiry_specific_date : ''; ?>" style="<?php echo ($oAdvMultipleCoupon->expiry == 'specific-date') ? 'display:block;' : 'display:none;'; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-right hidden">
                                                <div class="form-group">
                                                    <label class="control-label">&nbsp;</label>
                                                    <div>
                                                        <input type="hidden" name="couponType" value="advocate_multiple_coupons" />
                                                        <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                                        <button type="submit" class="btn dark_btn ml20 bkg_dgreen multipalCouponCodesSubmit"><span>Save Changes</span> </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="p20"> <button type="button" class="btn white_btn"><span>Cancel</span> </button>
                                        <button type="button" class="btn dark_btn ml20 bkg_dgreen adSaveAll"><span>Save Changes</span> </button></div>
                                </div>


                                <!-- *--- end ---* -->

                            </div>

                            <div class="advocate_desc" id="advocate-cash-new" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->cash_id > 0) ? 'display:block;' : 'display:none;' ?>">
                                <form name="frmAdvocateCash" id="frmAdvocateCash" method="post" data-container-id="advocate-free-gift" >
									{{ csrf_field() }}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Amount</label>
                                            <div class="">
                                                <input name="advocate_discount_price" class="form-control" type="text" value="<?php echo (!empty($oSettings->amount)) ? $oSettings->amount : ''; ?>" required placeholder="10">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div class="">
                                                <div class="input-group">
													<?php
													if ($oSettings->amount_type == 'dollar') {
														$dollarCash = 'table-cell';
														$percentCash = 'none';
														$advCashDisValue = '$';
													} else if ($oSettings->amount_type == 'percent') {
														$percentCash = 'table-cell';
														$dollarCash = 'none';
														$advCashDisValue = '%';
													} else {
														$dollarCash = 'none';
														$percentCash = 'table-cell';
														$advCashDisValue = '%';
													}
													?>
                                                    <input type="hidden" name="amount_type" class="form-control amount_type" value="<?php echo (!empty($oSettings->amount_type)) ? $oSettings->amount_type : 'percent'; ?>">

                                                    <input type="text" name="" value="<?php echo $advCashDisValue; ?>" id="adCashVal" class="form-control" readonly />

                                                    <span style="display: <?php echo $dollarCash; ?>;" class="input-group-addon bkg_dgreen bor_n adCashType" amtSign="%" amtText="percent"><i class="icon-percent txt_white"></i></span>
                                                    <span style="display: <?php echo $percentCash; ?>;" class="input-group-addon bkg_dgreen bor_n adCashType" amtSign="$" amtText="dollar"><i class="icon-coin-dollar txt_white"></i></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label">Reward Message</label>
                                            <div class="">

                                                <input type="text" name="advocate_cash" class="form-control" value="<?php echo (!empty($oSettings->display_msg)) ? $oSettings->display_msg : '$10 in cash'; ?>" placeholder="e.g. $10 in cash" required="required" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div>
                                                <input type="hidden" name="rewardType" value="advocate_cash" />
                                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                                <button type="button" class="btn white_btn"><span>Cancel</span> </button>
                                                <button type="submit" class="btn dark_btn ml20 bkg_dgreen"><span>Save Changes</span> </button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="advocate_desc " id="advocate-custom-new" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->custom_id > 0) ? 'display:block;' : 'display:none;' ?>">
                                <form name="frmAdvocateCustom" id="frmAdvocateCustom" method="post" data-container-id="advocate-free-gift" >


                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label">Reward Message</label>
                                            <div class="">

                                                <input type="text" name="advocate_custom" class="form-control" value="<?php echo (!empty($oSettings->reward_title)) ? $oSettings->reward_title : 'a free gift'; ?>" placeholder="e.g. a free gift" required="required" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div>
                                                <input type="hidden" name="rewardType" value="advocate_custom" />
                                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                                <button type="button" class="btn white_btn"><span>Cancel</span> </button>
                                                <button type="submit" class="btn dark_btn ml20 bkg_dgreen"><span>Save Changes</span> </button>

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



        <!--------------------------Friends Reward------------------------------------->
        <div class="row mt10 mb10">
            <div class="col-md-6">
                <div class="">
                    <p class="fsize16 fw500 txt_dark">Friends Reward</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-right">
                    <p class="fsize14 fw300 txt_grey">Select gift</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 text-center">
                <label for="temp4" class="m0 friendGift" option-type="#referred-discount-new">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input class="checkFriendGift" type="radio" name="friendsGiftType" value="coupon" id="temp4" <?php echo ($oSettings->ref_coupon_id > 0) ? 'checked' : ''; ?>>
                            <span class="custmo_checkmark green_tr"></span>
                        </label>
                        <div class="img_box img_inactive" style="<?php echo ($oSettings->ref_coupon_id > 0) ? 'display:none;' : 'display:block;' ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_1.png"/>
                        </div>

                        <div class="img_box img_active" style="<?php echo ($oSettings->ref_coupon_id > 0) ? 'display:block;' : 'display:none;' ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_1_act.png"/>
                        </div>


                        <p class="fsize14 txt_dark fw500">Coupon</p>
                        <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
                    </div>
                </label>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp5" class="m0 friendGift" option-type="#referred-promo-new">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input class="checkFriendGift" type="radio" name="friendsGiftType" value="cash" id="temp5" <?php echo ($oSettings->promo_id > 0) ? 'checked' : ''; ?>>
                            <span class="custmo_checkmark green_tr"></span>
                        </label>
                        <div class="img_box img_inactive" style="<?php echo ($oSettings->promo_id > 0) ? 'display:none;' : 'display:block;' ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_2.png"/>
                        </div>

                        <div class="img_box img_active" style="<?php echo ($oSettings->promo_id > 0) ? 'display:block;' : 'display:none;' ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_2_act.png"/>
                        </div>

                        <p class="fsize14 txt_dark fw500">Cash</p>
                        <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
                    </div>
                </label>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp6" class="m0 friendGift" option-type="#referred-no-discount-new">
                    <div class="broadcast_select_contact ref">
                        <label class="custmo_checkbox">
                            <input class="checkFriendGift" type="radio" name="friendsGiftType" value="custom" id="temp6" <?php echo ($oSettings->no_discount > 0) ? 'checked' : ''; ?>>
                            <span class="custmo_checkmark green_tr"></span>
                        </label>
                        <div class="img_box img_inactive" style="<?php echo ($oSettings->no_discount > 0) ? 'display:none;' : 'display:block;' ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_3.png"/>
                        </div>
                        <div class="img_box img_active" style="<?php echo ($oSettings->no_discount > 0) ? 'display:block;' : 'display:none;' ?>">
                            <img src="<?php echo base_url(); ?>assets/images/ref_reward_3_act.png"/>
                        </div>
                        <p class="fsize14 txt_dark fw500">Custom</p>
                        <p class="fsize12 txt_grey fw300">Custom discount for advocate</p>
                    </div>
                </label>
            </div>
        </div>

<?php
//pre($oSettings);
if ($oSettings->ref_coupon_id > 0) {
    $displayG = 'block';
} else if ($oSettings->promo_id > 0) {
    $displayG = 'block';
} else if ($oSettings->no_discount == 'yes') {
    $displayG = 'block';
} else {
    $displayG = 'none';
}
?>



        <div class="row mt20">
            <div class="col-md-12">
                <div class="white_box p20 pl30 pr30">
                    <div class="row">
                        <div class="col-md-12 mb20">
                            <p class="fsize15 bbot pb-15">Gift Configuration</p>
                        </div>
                    </div>

                    <div class="p20 friendGiftD" style="display: <?php echo $displayG; ?>;">
                        <div class="row">

                            <div class="referred_desc" id="referred-discount-new" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->ref_coupon_id > 0) ? 'display:block;' : 'display:none;' ?>">
                                <form name="frmReferredDiscount" id="frmReferredDiscount" method="post" data-container-id="referred-friend-gift" >
                                    <input type="hidden" name="rewardType" value="referred_discount" />
									{{ csrf_field() }}
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label">Reward Message</label>
                                            <div class="">

                                                <input type="text" name="referred_discount" class="form-control" value="<?php echo (!empty($oSettings->referred_display_msg)) ? $oSettings->referred_display_msg : '20% off'; ?>" placeholder="e.g. 20% off" required="required" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div>

                                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                                <button type="button" style="display: none;" class="btn white_btn"><span>Cancel</span> </button>
                                                <button type="submit" style="display: none;" class="btn dark_btn ml20 bkg_dgreen frdReferredDiscountSave"><span>Save Changes</span> </button>

                                            </div>
                                        </div>
                                    </div>
                                </form>


                                <!-- *------ start friend ------* -->
                                <div class="clearfix"></div>
                                <div class="panel-body" style="box-shadow: none;">

                                    <!-- Option A -->

                                    <div class="radio">
                                        <label>
                                            <span>
                                                <input type="radio" name="refCouponCode" option-type="ref_single_use_coupons" <?php if ($oSettings->referred_coupon_type == 'single'): ?> checked="checked" <?php endif; ?> class="control-primary referred_options">
                                            </span>
                                            <strong>Single Use Coupons</strong> Unique coupon codes for every friend 

                                        </label>

                                    </div>
                                    <div class="coupon_desc_ref" id="referred-single-use_code" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->referred_coupon_type == 'single') ? 'display:block;' : 'display:none;' ?>">
                                        <form name="frmRefSingleUseCodes" id="frmRefSingleUseCodes" method="post" data-container-id="referred-friend-coupon" >
											{{ csrf_field() }}
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="control-label">Paste your coupon codes here</label>
                                                    <div class="">
                                                        <textarea name="singleCouponCodes"  class="form-control"  placeholder="list of coupon codes" required="required" ><?php
        if (!empty($aRefCoupons)) {
            echo trim(implode(",", $aRefCoupons));
        }
?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <div class="form-group">
                                                    <label class="control-label">&nbsp;</label>
                                                    <div>
                                                        <input type="hidden" name="couponType" value="referred_single_coupons" />
                                                        <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                                        <button type="submit" style="display: none;" class="btn dark_btn ml20 bkg_dgreen singleReferredCodesSubmit"><span>Save Changes</span> </button>

                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="clearfix"></div>


                                    <!-- Option B -->
                                    <div class="radio">
                                        <label>
                                            <span>
                                                <input type="radio" name="refCouponCode" option-type="ref_multiple_use_coupons" <?php if ($oSettings->referred_coupon_type == 'multiple'): ?> checked="checked" <?php endif; ?> class="control-primary referred_options">
                                            </span>
                                            <strong>Multiple Use Coupons</strong> Reusable coupon code for all friends 

                                        </label>

                                    </div>


                                    <div class="coupon_desc_ref" id="referred-multiple-use_code" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->referred_coupon_type == 'multiple') ? 'display:block;' : 'display:none;' ?>">
                                        <form name="frmRefMultipleUseCodes" id="frmRefMultipleUseCodes" method="post" data-container-id="referred-friend-coupon">
											{{ csrf_field() }}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Paste your coupon code</label>
                                                    <div class="">
                                                        <input type="text" class="form-control" name="multipleCouponCodes" value="<?php echo ($oRefMultipleCoupon->coupon_code) ? $oRefMultipleCoupon->coupon_code : ''; ?>" id="multipleRefCouponCodes" placeholder="e.g. REWARD10" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Expiry</label>
                                                    <div class="">
                                                        <select class="form-control" id="ref_coupon_expiry" name="coupon_expiry">
                                                            <option value="never" <?php echo ($oRefMultipleCoupon->expiry == 'never') ? 'selected = "selected"' : ''; ?> >Never(Recommended)</option>
                                                            <option value="6" <?php echo ($oRefMultipleCoupon->expiry == '6') ? 'selected = "selected"' : ''; ?>>6 Months</option>
                                                            <option value="5" <?php echo ($oRefMultipleCoupon->expiry == '5') ? 'selected = "selected"' : ''; ?>>5 Months</option>
                                                            <option value="4" <?php echo ($oRefMultipleCoupon->expiry == '4') ? 'selected = "selected"' : ''; ?>>4 Months</option>
                                                            <option value="3" <?php echo ($oRefMultipleCoupon->expiry == '3') ? 'selected = "selected"' : ''; ?>>3 Months</option>
                                                            <option value="2" <?php echo ($oRefMultipleCoupon->expiry == '2') ? 'selected = "selected"' : ''; ?>>2 Months</option>
                                                            <option value="1" <?php echo ($oRefMultipleCoupon->expiry == '1') ? 'selected = "selected"' : ''; ?>>1 Months</option>
                                                            <option value="specific-date" <?php echo ($oRefMultipleCoupon->expiry == 'specific-date') ? 'selected = "selected"' : ''; ?>>Specific Date</option>

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">&nbsp;</label>
                                                    <div class="">
                                                        <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="ref_specific_expiry_picker" value="<?php echo ($oRefMultipleCoupon->expiry_specific_date) ? $oRefMultipleCoupon->expiry_specific_date : ''; ?>" style="<?php echo ($oRefMultipleCoupon->expiry == 'specific-date') ? 'display:block;' : 'display:none;'; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <div class="form-group">
                                                    <label class="control-label">&nbsp;</label>
                                                    <div>
                                                        <input type="hidden" name="couponType" value="referred_multiple_coupons" />
                                                        <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                                        <button type="submit" style="display: none;" class="btn dark_btn ml20 bkg_dgreen multipalReferredCodesSubmit"><span>Save Changes</span> </button>

                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="p20">
                                        <button type="button" class="btn white_btn"><span>Cancel</span> </button>
                                        <button type="button" class="btn dark_btn ml20 bkg_dgreen frRewardSaveAll"><span>Save Changes</span></button>
                                    </div>

                                </div>

                                <!-- *------ end friend ------* -->


                            </div>


                            <div class="referred_desc" id="referred-promo-new" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->promo_id > 0) ? 'display:block;' : 'display:none;' ?>">
                                <form name="frmReferredPromo" id="frmReferredPromo" method="post" data-container-id="referred-friend-gift" >
									{{ csrf_field() }}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Promo link</label>
                                            <div class="">

                                                <input type="text" name="referred_promo_link" class="form-control" value="<?php echo (!empty($oSettings->link_url)) ? $oSettings->link_url : ''; ?>" placeholder="e.g. http://yourstore.com/discount/link" required="required" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Give friends</label>
                                            <div class="">

                                                <input type="text" name="referred_promo_desc" class="form-control" value="<?php echo (!empty($oSettings->link_desc)) ? $oSettings->link_desc : ''; ?>" placeholder="e.g. 20% off" required="required" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Link Expiry</label>
                                            <div class="">
                                                <select class="form-control" id="promo_expiry" name="promo_expiry">
                                                    <option value="never" <?php echo ($oSettings->expiry == 'never') ? 'selected = "selected"' : ''; ?> >Never(Recommended)</option>
                                                    <option value="6" <?php echo ($oSettings->expiry == '6') ? 'selected = "selected"' : ''; ?>>6 Months</option>
                                                    <option value="5" <?php echo ($oSettings->expiry == '5') ? 'selected = "selected"' : ''; ?>>5 Months</option>
                                                    <option value="4" <?php echo ($oSettings->expiry == '4') ? 'selected = "selected"' : ''; ?>>4 Months</option>
                                                    <option value="3" <?php echo ($oSettings->expiry == '3') ? 'selected = "selected"' : ''; ?>>3 Months</option>
                                                    <option value="2" <?php echo ($oSettings->expiry == '2') ? 'selected = "selected"' : ''; ?>>2 Months</option>
                                                    <option value="1" <?php echo ($oSettings->expiry == '1') ? 'selected = "selected"' : ''; ?>>1 Months</option>
                                                    <option value="specific-date" <?php echo ($oSettings->expiry == 'specific-date') ? 'selected = "selected"' : ''; ?>>Specific Date</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div>
                                                <input type="hidden" name="rewardType" value="referred_promo" />
                                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                                <button type="button" class="btn white_btn"><span>Cancel</span> </button>
                                                <button type="submit" class="btn dark_btn ml20 bkg_dgreen"><span>Save Changes</span> </button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="referred_desc" id="referred-no-discount-new" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->no_discount == 'yes') ? 'display:block;' : 'display:none;' ?>">
                                <form name="frmReferredNoDiscount" id="frmReferredNoDiscount" method="post" data-container-id="referred-friend-gift" >
									{{ csrf_field() }}
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label">Reward Message</label>
                                            <div class="">

                                                <input type="text" name="referred_no_discount" class="form-control" value="<?php echo (!empty($oSettings->reward_title)) ? $oSettings->reward_title : 'a free gift'; ?>" placeholder="e.g. a free gift" required="required" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div>
                                                <input type="hidden" name="rewardType" value="referred_no_discount" />
                                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                                <button type="button" class="btn white_btn"><span>Cancel</span> </button>
                                                <button type="submit" class="btn dark_btn ml20 bkg_dgreen"><span>Save Changes</span> </button>

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




        <!--==================Button area============-->
        <div class="row">
            <div class="col-md-12">
                <div class="mt30 mb30" style="height: 1px; border-bottom: 1px solid #eee;"></div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" name="refId" id="refId" value="<?php echo $moduleUnitID; ?>">
            <div class="col-md-6"><button class="btn btn_white bkg_white h52 txt_dark minw_140 shadow br5 backPage"><i class="icon-arrow-left12 mr20"></i> Back</button></div>
            <div class="col-md-6 text-right"><button class="btn dark_btn bkg_dgreen2 h52 minw_160 continueWorkflow">Next step <i class="icon-arrow-right13 ml20"></i></button></div>
        </div>
    </div>

    <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->

</div>

<div id="addPeopleList" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-user"></i>&nbsp; Contacts</h5>
            </div>
            <div class="modal-body">
                <div class="panel-body">

                    <form name="frmInviteCustomer" id="frmInviteCustomer" method="post" action="" >
						{{ csrf_field() }}
                        <input type="hidden" name="userid" value="<?php echo $userID; ?>" />
                        <input type="hidden" name="bbaid" value="<?php echo $oSettings->hashcode; ?>" />
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="firstname" id="firstname" class="form-control" type="text" required="">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="lastname" id="lastname" class="form-control" value="" type="text" required="">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="email" id="email" value="" class="form-control" type="text" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="phone" id="phone" value="" class="form-control" type="text">
                                </div>
                            </div>

                            <button class="btn btn-success pull-right" id="btnInvite" type="submit">
                                Invite Advocates
                            </button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
	$(document).on("click", ".continueWorkflow", function () {
		$('.overlaynew').show();
		var refId = $("#refId").val();
		window.location.href = '<?php echo base_url('/admin/modules/referral/workflow/'); ?>'+refId;
	});
	
	$(document).on("click", ".backPage", function () {
		$('.overlaynew').show();
		var refId = $("#refId").val();
		window.location.href = '<?php echo base_url('/admin/modules/referral/setup/'); ?>'+refId;
	});
	
	$(document).on('click', '.advocateGift', function() {
		var optionType = $(this).attr('option-type');
		$('.advocateGiftHeading').show();
		$('.advocateGiftD').show();
		$('.advocate_desc').hide();
		$(optionType).show();
	});

    $(document).on('click', '.publishReferralStatus', function() {

        var status = $(this).attr('status');
        $.ajax({
            url: '<?php echo base_url('admin/modules/referral/publishReferralStatus'); ?>',
            type: "POST",
            data: {'ref_id': '<?php echo $moduleUnitID; ?>', 'status':status, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    if(status == 'active') {
                        
                        displayMessagePopup('success', 'Campaign pushlished successfully');
                    }
                    else {
                         displayMessagePopup('success', 'Campaign saved as draft successfully');
                    }
                    
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }
        });
        
    });
	
	$(document).on('click', '.friendGift', function() {
		$('.friendGift').removeClass('active_green');
		$(this).addClass('active_green');
		var optionType = $(this).attr('option-type');
		
		$('.referred_desc').hide();
		$('.friendGiftHeading').show();
		$('.friendGiftD').show();
		$(optionType).show();
	});
		
	$(document).on('click', '.adCouponType', function() {
		$('.adCouponType').show();
		$(this).hide();
		var amtSign = $(this).attr('amtSign');
		var amtText = $(this).attr('amtText');
		$('#adCouponVal').val(amtSign);
		$('.advocate_discount_type').val(amtText);
	});

	$(document).on('click', '.adCashType', function() {
		$('.adCashType').show();
		$(this).hide();
		var amtSign = $(this).attr('amtSign');
		var amtText = $(this).attr('amtText');
		$('#adCashVal').val(amtSign);
		$('.amount_type').val(amtText);
	});

	$(document).on('click', '.adSaveAll', function() {
		$('.advDiscountSave').trigger('click');
		if($('#advocate-single-use_code').css('display') != 'none')
		{
			setTimeout(function(){ $('.singleCouponCodesSubmit').trigger('click'); }, 1000);
		}
		if($('#advocate-multiple-use_code').css('display') != 'none')
		{
			setTimeout(function(){ $('.multipalCouponCodesSubmit').trigger('click'); }, 1000);
		}
	});


	$(document).on('click', '.frRewardSaveAll', function() {
		$('.frdReferredDiscountSave').trigger('click');
		if($('#referred-single-use_code').css('display') != 'none')
		{
			setTimeout(function(){ $('.singleReferredCodesSubmit').trigger('click'); }, 1000);
		}
		if($('#referred-multiple-use_code').css('display') != 'none')
		{
			setTimeout(function(){ $('.multipalReferredCodesSubmit').trigger('click'); }, 1000);
		}
	});
	
	$(document).on("click", ".continueWorkflow", function () {
		$('.overlaynew').show();
		var refId = $("#refId").val();
		window.location.href = '<?php echo base_url('/admin/modules/referral/workflow/'); ?>'+refId;
	});
	
	$("#frmInviteCustomer").submit(function () {
		$('.overlaynew').show();
		var formData = new FormData($(this)[0]);
		$('#btnInvite').prop("disabled", true);
		$.ajax({
			url: '<?php echo base_url('admin/modules/referral/registerInvite'); ?>',
			type: "POST",
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {
				$('.overlaynew').hide();
				if (data.status == 'success') {
					window.location.href = window.location.href;
				} else {
					alertMessage('Error: Some thing wrong!');
					$('.overlaynew').hide();
				}
			}
		});
		return false;
	});
			
	$('.checkAdvocateGift').change(function(){
		$('.advocateGift .broadcast_select_contact').find(".img_inactive").show();
		$('.advocateGift .broadcast_select_contact').find(".img_active").hide();
		if($(this).prop("checked")){
			$(this).parent().parent().find(".img_inactive").hide();
			$(this).parent().parent().find(".img_active").show();
		}else{
			$(this).parent().parent().find(".img_inactive").show();
			$(this).parent().parent().find(".img_active").hide();
		}
	});
	
	$('.checkFriendGift').change(function(){
		$('.friendGift .broadcast_select_contact').find(".img_inactive").show();
		$('.friendGift .broadcast_select_contact').find(".img_active").hide();
		if($(this).prop("checked")){
			$(this).parent().parent().find(".img_inactive").hide();
			$(this).parent().parent().find(".img_active").show();
		}else{
			$(this).parent().parent().find(".img_inactive").show();
			$(this).parent().parent().find(".img_active").hide();
		}
	});
	
	$(".advocate_options, .referred_options").change(function () {
		var selectedOption = $(this).attr('option-type');
		if($(this).hasClass('advocate_options')){
			$("#advocate_coupon_details").hide();
		}else{
			$("#referred_coupon_details").hide();
		}

		if (selectedOption == "discount") {
			$(".advocate_desc").hide();
			$("#advocate-discount").show();
			$("#advocate_coupon_details").show();
		} else if (selectedOption == "cash") {
			$(".advocate_desc").hide();
			$("#advocate-cash").show();
		} else if (selectedOption == "custom") {
			$(".advocate_desc").hide();
			$("#advocate-custom").show();
		} else if (selectedOption == "referred_discount") {
			$("#referred_coupon_details").show();
			$(".referred_desc").hide();
			$("#referred-discount").show();
		} else if (selectedOption == "promo") {
			$(".referred_desc").hide();
			$("#referred-promo").show();
		} else if (selectedOption == "no-reward") {
			$(".referred_desc").hide();
			$("#referred-no-discount").show();
		} else if (selectedOption == "adv_single_use_coupons") {
			$(".coupon_desc").hide();
			$("#advocate-single-use_code").show();
			$("#advocate_coupon_details").show();
		} else if (selectedOption == "adv_multiple_use_coupons") {
			$(".coupon_desc").hide();
			$("#advocate-multiple-use_code").show();
			$("#advocate_coupon_details").show();
		} else if (selectedOption == "ref_single_use_coupons") {
			$(".coupon_desc_ref").hide();
			$("#referred-single-use_code").show();
			$("#referred_coupon_details").show();
		} else if (selectedOption == "ref_multiple_use_coupons") {
			$(".coupon_desc_ref").hide();
			$("#referred-multiple-use_code").show();
			$("#referred_coupon_details").show();
		}

	});

	$("#frmAdvocateDiscount, #frmAdvocateCash, #frmAdvocateCustom, #frmReferredDiscount, #frmReferredPromo, #frmReferredNoDiscount").submit(function () {
		var formdata = $(this).serialize();
		var frmSplit = formdata.split('&');
		if(frmSplit.length > 0) {
			var strSplit = frmSplit[0].split('=');
			var strSplitS = strSplit[1];
		}
		else {
			var strSplitS = '';
		}
		
		var elem = $(this);
		$('.overlaynew').show();
		$.ajax({
			url: '<?php echo base_url('admin/modules/referral/saveRewards'); ?>',
			type: "POST",
			data: formdata,
			dataType: "json",
			success: function (data) {
				if (data.status == 'success') {
					$('.overlaynew').hide();
					var elemID = $(elem).attr('data-container-id');
					$("#"+elemID).trigger("click");
					if($("#"+elemID).parent().parent().parent().next(':visible').length>0){
						if($("#"+elemID).parent().parent().parent().next().find("a").hasClass("collapsed")){
							$("#"+elemID).parent().parent().parent().next().find("a").trigger("click");
						}
					}else if($("#"+elemID).parent().parent().parent().next().next().length>0){
						if($("#"+elemID).parent().parent().parent().next().next().find("a").hasClass("collapsed")){
							$("#"+elemID).parent().parent().parent().next().next().find("a").trigger("click");
						}
					}
				}
			}
		});
		return false;
	});


	$("#frmAdvSingleUseCodes, #frmAdvMultipleUseCodes, #frmRefSingleUseCodes, #frmRefMultipleUseCodes").submit(function () {
		var formdata = $(this).serialize();
		var elem = $(this);
		$.ajax({
			url: '<?php echo base_url('admin/modules/referral/saveCoupons'); ?>',
			type: "POST",
			data: formdata,
			dataType: "json",
			success: function (data) {
				if (data.status == 'success') {
					var elemID = $(elem).attr('data-container-id');
					$("#"+elemID).trigger("click");
					
					if($("#"+elemID).parent().parent().parent().next(':visible').length>0){
						if($("#"+elemID).parent().parent().parent().next().find("a").hasClass("collapsed")){
							$("#"+elemID).parent().parent().parent().next().find("a").trigger("click");
						}
					}else if($("#"+elemID).parent().parent().parent().next().next().length>0){
						if($("#"+elemID).parent().parent().parent().next().next().find("a").hasClass("collapsed")){
							$("#"+elemID).parent().parent().parent().next().next().find("a").trigger("click");
						}
					}
				}
			}
		});
		return false;
	});
});
</script>
@endsection