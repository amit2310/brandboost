<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<?php

//$tab = $this->input->get()['tab'];
//echo $tab;
//die;
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
<div class="tab-pane <?php echo ($defalutTab == 'reward')? 'active': '';?>" id="right-icon-tab2">
    <?php //pre($oSettings); ?>
  <div class="row">
      <div class="col-md-12">
        <div class="panel panel-flat">
          <div class="panel-heading">
            <h6 class="panel-title">Give advocates a free gift</h6>
          </div>
          <div class="panel-body p0">
              <div class="p20 bbot">
                <div class="row">
                    <div class="col-md-4 review_source">
                        <input type="hidden" name="adv_coupon_v" id="adv_coupon_v" value="<?php echo $oSettings->adv_coupon_id; ?>">
                        <div class="inner pt30 advocateGift <?php echo $oSettings->adv_coupon_id > 0? 'active_green':''; ?>" option-type="#advocate-discount-new">
                        <div class="img_icon mb20"><img src="/assets/images/icon_coupan.jpg" width="36"></div>
                            <div class="text_sec">
                            <p><strong>Coupon</strong></p>
                            <h5>Coupons Discount for <br> Advocates</h5>   
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 review_source">
                        <div class="inner pt30 advocateGift <?php echo $oSettings->cash_id > 0? 'active_green':''; ?>" option-type="#advocate-cash-new">
                        <div class="img_icon mb20"><img src="/assets/images/icon_cash.png" width="36"></div>
                            <div class="text_sec">
                            <p><strong>Cash</strong></p>
                            <h5>Cash Attract one-time <br> Advocates</h5>   
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4 review_source">
                        <div class="inner pt30 advocateGift <?php echo $oSettings->custom_id > 0? 'active_green':''; ?>" option-type="#advocate-custom-new">
                        <div class="img_icon mb20"><img src="/assets/images/icon_card2.png" width="36"></div>
                            <div class="text_sec">
                            <p><strong>Reward</strong></p>
                            <h5>Custom Manually fulfill a custom <br>reward</h5>   
                            </div>
                        </div>
                    </div>

                </div>
              </div>

              <?php 
                if($oSettings->adv_coupon_id > 0) {
                    $display = 'block';
                }
                else if($oSettings->cash_id > 0) {
                    $display = 'block';
                }
                else if($oSettings->custom_id > 0) {
                    $display = 'block';
                }
                else {
                    $display = 'none';
                }
              ?>

              <div class="p20 bbot advocateGiftHeading" style="display: <?php echo $display; ?>;">
                <p class="mb0 fsize12 txt_dark"><strong>Gift Configuration</strong></p>
              </div>
            
              <div class="p20 advocateGiftD" style="display: <?php echo $display; ?>;">
                <div class="row">
                    
                    <div class="advocate_desc" id="advocate-discount-new" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->adv_coupon_id > 0) ? 'display:block;' : 'display:none;' ?>">
                        <form name="frmAdvocateDiscount" id="frmAdvocateDiscount" method="post" data-container-id="advocate-free-gift" >

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
                                if($oSettings->advocate_discount_type == 'dollar') {
                                    $dollarCoupon = 'table-cell';
                                    $percentCoupon = 'none';
                                    $advDisValue = '$';
                                }
                                else if($oSettings->advocate_discount_type == 'percent') {
                                    $percentCoupon = 'table-cell';
                                    $dollarCoupon = 'none';
                                    $advDisValue = '%';
                                }
                                else {
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
                    <div class="col-md-3 text-right">
                        <div class="form-group">
                          <label class="control-label">&nbsp;</label>
                          <div>
                            
                            <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                            <button type="button" style="display: none;" class="btn white_btn"><span>Cancel</span> </button>
                            <button type="submit" style="display: none;" class="btn dark_btn ml20 bkg_dgreen advDiscountSave"><span>Save Changes</span> </button>

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
                    <div class="col-md-2 text-right">
                        <div class="form-group">
                          <label class="control-label">&nbsp;</label>
                          <div>
                            <input type="hidden" name="couponType" value="advocate_single_coupons" />
                            <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                            <button type="submit" style="display: none;" class="btn dark_btn ml20 bkg_dgreen singleCouponCodesSubmit"><span>Save Changes</span> </button>

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
                           
                    <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Paste your coupon code</label>
                          <div class="">
                            <input type="text" class="form-control" name="multipleCouponCodes" value="<?php echo ($oAdvMultipleCoupon->coupon_code) ? $oAdvMultipleCoupon->coupon_code : ''; ?>" id="multipleCouponCodes" placeholder="e.g. REWARD10" />
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
                    <div class="col-md-2 text-right">
                        <div class="form-group">
                          <label class="control-label">&nbsp;</label>
                          <div>
                            <input type="hidden" name="couponType" value="advocate_multiple_coupons" />
                            <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                            <button type="submit" style="display: none;" class="btn dark_btn ml20 bkg_dgreen multipalCouponCodesSubmit"><span>Save Changes</span> </button>

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
                                if($oSettings->amount_type == 'dollar') {
                                    $dollarCash = 'table-cell';
                                    $percentCash = 'none';
                                    $advCashDisValue = '$';
                                }
                                else if($oSettings->amount_type == 'percent') {
                                    $percentCash = 'table-cell';
                                    $dollarCash = 'none';
                                    $advCashDisValue = '%';
                                }
                                else {
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

      <!-- ****************** Referal friend ********************** -->
      
      <div class="col-md-12">
        <div class="panel panel-flat">
          <div class="panel-heading">
            <h6 class="panel-title">Give referred friend a free gift</h6>
          </div>
          <div class="panel-body p0">
            <div class="p20 bbot">
                <div class="row">

                    <div class="col-md-4 review_source">
                        <input type="hidden" name="ref_coupon_v" id="ref_coupon_v" value="<?php echo $oSettings->ref_coupon_id; ?>">
                        <div class="inner pt30 friendGift <?php echo $oSettings->ref_coupon_id > 0? 'active_green':''; ?>" option-type="#referred-discount-new">
                        <div class="img_icon mb20"><img src="/assets/images/icon_coupan.jpg" width="36"></div>
                            <div class="text_sec">
                            <p><strong>Coupon</strong></p>
                            <h5>Coupons Discount for Referred <br> Customers</h5> 
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 review_source">
                        <div class="inner pt30 friendGift <?php echo $oSettings->promo_id > 0? 'active_green':''; ?>" option-type="#referred-promo-new">
                        <div class="img_icon mb20"><img src="/assets/images/icon_card2.png" width="36"></div>
                            <div class="text_sec">
                            <p><strong>Cash</strong></p>
                            <h5>Promo Link Custom reward link for new <br> customers</h5>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4 review_source">
                        <div class="inner pt30 friendGift <?php echo $oSettings->no_discount == 'yes'? 'active_green':''; ?>" option-type="#referred-promo-new">
                        <div class="img_icon mb20"><img src="/assets/images/cross2.png" width="21"></div>
                            <div class="text_sec">
                            <p><strong>Reward</strong></p>
                            <h5> No Reward</h5>    
                            </div>
                        </div>
                    </div>

                </div>
            </div>

         
            <?php 
                //pre($oSettings);
                if($oSettings->ref_coupon_id > 0) {
                    $displayG = 'block';
                }
                else if($oSettings->promo_id > 0) {
                    $displayG = 'block';
                }
                else if($oSettings->no_discount == 'yes') {
                    $displayG = 'block';
                }
                else {
                    $displayG = 'none';
                }
              ?>

            <div class="p20 bbot friendGiftHeading" style="display: <?php echo $displayG; ?>;">
                <p class="mb0 fsize12 txt_dark"><strong>Gift Configuration</strong></p>
            </div>

            <div class="p20 friendGiftD" style="display: <?php echo $displayG; ?>;">
                <div class="row">

                    <div class="referred_desc" id="referred-discount-new" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->ref_coupon_id > 0) ? 'display:block;' : 'display:none;' ?>">
                        <form name="frmReferredDiscount" id="frmReferredDiscount" method="post" data-container-id="referred-friend-gift" >
                        <input type="hidden" name="rewardType" value="referred_discount" />
                   
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

                    <div class="col-md-3">
                    
                    </div>
                    <div class="col-md-1">
                       
                    </div>
                    <div class="col-md-5">
                        
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
    </div>
                     
<!-- *-------------old-----------------* -->
    <?php /*?>
    <div class="panel-group panel-group-control content-group-lg"> 
        <div class="panel panel-white" id="right-icon-tab2">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a data-toggle="collapse" href="#collapsible-control-group1" id="advocate-free-gift" aria-expanded="false" <?php if ($tab != 'advocate'): ?> class="collapsed" <?php endif; ?>>Give advocates a free gift</a>
                </h6>
            </div>
            <div id="collapsible-control-group1" class="panel-collapse collapse <?php echo ($tab == 'advocate') ? 'in' : ''; ?>" aria-expanded="<?php echo ($tab == 'advocate') ? 'true' : 'false'; ?>" style="<?php echo ($tab == 'advocate') ? '' : 'height: 0px;'; ?>">
                <div class="panel-body">



                    <!-- Option A -->

                    <div class="radio">
                        <label>
                            <span>
                                <input type="radio" name="advocate_options" option-type="discount" <?php if ($oSettings->adv_coupon_id > 0): ?> checked="checked" <?php endif; ?> class="control-primary advocate_options">
                            </span>
                            Coupons Discount for Advocates 

                        </label>

                    </div>
                    <div class="advocate_desc" id="advocate-discount" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->adv_coupon_id > 0) ? 'display:block;' : 'display:none;' ?>">
                        <form name="frmAdvocateDiscount" id="frmAdvocateDiscount" method="post" data-container-id="advocate-free-gift" >
                            Get <input type="text" name="advocate_discount" style="width:100px;padding:5px;" value="<?php echo (!empty($oSettings->advocate_display_msg)) ? $oSettings->advocate_display_msg : '20% off'; ?>" placeholder="e.g. 20% off" required="required" > for referring friends!
                            <div class="clearfix"></div>
                            <span class="alert-danger">What message should your advocates see?</span>
                            <div class="clearfix"></div>
                            <br>
                            <span><strong>Hint:</strong>Choose either % discount or $ discount</span>
                            <br>
                            <br>
                            <div class="col-md-12 text-right">
                                <input type="hidden" name="rewardType" value="advocate_discount" />
                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />

                                <button type="submit" class="btn bl_cust_btn bg-blue-600"> Save <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

                            </div>
                            <div class="clearfix"></div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>






                    <!-- Option B -->
                    <div class="radio">
                        <label>
                            <span>
                                <input type="radio" name="advocate_options" option-type="cash" <?php if ($oSettings->cash_id > 0): ?> checked="checked" <?php endif; ?> class="control-primary advocate_options">
                            </span>
                            Cash Attract one-time advocates 

                        </label>
                    </div>
                    <div class="advocate_desc" id="advocate-cash" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->cash_id > 0) ? 'display:block;' : 'display:none;' ?>">
                        <form name="frmAdvocateCash" id="frmAdvocateCash" method="post" data-container-id="advocate-free-gift" >
                            Get <input type="text" name="advocate_cash" style="width:100px;padding:5px;" value="<?php echo (!empty($oSettings->display_msg)) ? $oSettings->display_msg : '$10 in cash'; ?>" placeholder="e.g. $10 in cash" required="required" > for referring friends!
                            <div class="clearfix"></div>
                            <span class="alert-danger">What message should your advocates see?</span>
                            <div class="clearfix"></div>
                            <br>
                            <span><strong>Hint:</strong>Choose either % cash or $ cash</span>
                            <br>
                            <br>
                            <div class="col-md-12 text-right">
                                <input type="hidden" name="rewardType" value="advocate_cash" />
                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                <button type="submit" class="btn bl_cust_btn bg-blue-600"> Save <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

                            </div>
                            <div class="clearfix"></div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>



                    <!-- Option C -->
                    <div class="radio">
                        <label>
                            <span>
                                <input type="radio" name="advocate_options" option-type="custom" <?php if ($oSettings->custom_id > 0): ?> checked="checked" <?php endif; ?> class="control-primary advocate_options">
                            </span>
                            Custom Manually fulfill a custom reward 

                        </label>
                    </div>
                    <div class="advocate_desc" id="advocate-custom" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->custom_id > 0) ? 'display:block;' : 'display:none;' ?>">
                        <form name="frmAdvocateCustom" id="frmAdvocateCustom" method="post" data-container-id="advocate-free-gift" >
                            Get <input type="text" name="advocate_custom" style="width:100px;padding:5px;" data-container-id="advocate-free-gift" value="<?php echo (!empty($oSettings->reward_title)) ? $oSettings->reward_title : 'a free gift'; ?>" placeholder="e.g. a free gift" required="required" > for referring friends!
                            <div class="clearfix"></div>
                            <span class="alert-danger">What message should your advocates see?</span>
                            <div class="clearfix"></div>
                            <br>
                            <span><strong>Hint:</strong>How do custom reward works</span>
                            <br>
                            <br>
                            <div class="col-md-12 text-right">
                                <input type="hidden" name="rewardType" value="advocate_custom" />
                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                <button type="submit" class="btn bl_cust_btn bg-blue-600"> Save <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

                            </div>
                            <div class="clearfix"></div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>


                </div>
            </div>
        </div>

        <div class="panel panel-white" id="advocate_coupon_details" style="display:<?php echo ($oSettings->adv_coupon_id > 0) ? 'block' : 'none'; ?>">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a data-toggle="collapse" href="#advocate_coupon_codes" id="advocate-coupon-details" aria-expanded="false" <?php if ($tab != 'advocate-coupons'): ?> class="collapsed" <?php endif; ?>>Add coupon codes for advocates</a>
                </h6>
            </div>
            <div id="advocate_coupon_codes" class="panel-collapse collapse <?php echo ($tab == 'advocate-coupons') ? 'in' : ''; ?>" aria-expanded="<?php echo ($tab == 'advocate-coupons') ? 'true' : 'false'; ?>" style="<?php echo ($tab == 'advocate-coupons') ? '' : 'height: 0px;'; ?>">
                <div class="panel-body">



                    <!-- Option A -->

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
                            Paste your coupon codes here:
                            <div class="clearfix"></div>
                            <textarea name="singleCouponCodes" rows="6" style="width:300px;padding:5px;" placeholder="list of coupon codes" required="required" ><?php
                                if (!empty($aAdvCoupons)) {
                                    echo trim(implode(",", $aAdvCoupons));
                                }
                                ?></textarea>

                            <br>
                            <br>
                            <div class="col-md-12 text-right">
                                <input type="hidden" name="couponType" value="advocate_single_coupons" />
                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />

                                <button type="submit" class="btn bl_cust_btn bg-blue-600"> Save <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

                            </div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>






                    <!-- Option B -->
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
                            Paste your coupon code:
                            <div class="clearfix"></div>
                            <input type="text" class="form-control" name="multipleCouponCodes" value="<?php echo ($oAdvMultipleCoupon->coupon_code) ? $oAdvMultipleCoupon->coupon_code : ''; ?>" id="multipleCouponCodes" placeholder="e.g. REWARD10" style="width:300px;" />
                            <div class="clearfix"></div>
                            <span class="alert-danger">Coupon Expiry</span>
                            <div class="clearfix"></div>
                            <br>
                            Expiry <select class="form-control" id="adv_coupon_expiry" name="coupon_expiry" style="width:300px;">
                                <option value="never" <?php echo ($oAdvMultipleCoupon->expiry == 'never') ? 'selected = "selected"' : ''; ?> >Never(Recommended)</option>
                                <option value="6" <?php echo ($oAdvMultipleCoupon->expiry == '6') ? 'selected = "selected"' : ''; ?>>6 Months</option>
                                <option value="5" <?php echo ($oAdvMultipleCoupon->expiry == '5') ? 'selected = "selected"' : ''; ?>>5 Months</option>
                                <option value="4" <?php echo ($oAdvMultipleCoupon->expiry == '4') ? 'selected = "selected"' : ''; ?>>4 Months</option>
                                <option value="3" <?php echo ($oAdvMultipleCoupon->expiry == '3') ? 'selected = "selected"' : ''; ?>>3 Months</option>
                                <option value="2" <?php echo ($oAdvMultipleCoupon->expiry == '2') ? 'selected = "selected"' : ''; ?>>2 Months</option>
                                <option value="1" <?php echo ($oAdvMultipleCoupon->expiry == '1') ? 'selected = "selected"' : ''; ?>>1 Months</option>
                                <option value="specific-date" <?php echo ($oAdvMultipleCoupon->expiry == 'specific-date') ? 'selected = "selected"' : ''; ?>>Specific Date</option>

                            </select>
                            <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="adv_specific_expiry_picker" value="<?php echo ($oAdvMultipleCoupon->expiry_specific_date) ? $oAdvMultipleCoupon->expiry_specific_date : ''; ?>" style="width:200px;<?php echo ($oAdvMultipleCoupon->expiry == 'specific-date') ? 'display:block;' : 'display:none;'; ?>"/>

                            <br>
                            <br>
                            <div class="col-md-12 text-right">
                                <input type="hidden" name="couponType" value="advocate_multiple_coupons" />
                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />

                                <button type="submit" class="btn bl_cust_btn bg-blue-600"> Save <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

                            </div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>




                </div>
            </div>
        </div>

        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a <?php if ($tab != 'referred'): ?> class="collapsed" <?php endif; ?> id="referred-friend-gift" data-toggle="collapse" href="#collapsible-control-group2" <?php echo ($tab == 'referred') ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?> >Give referred friend a free gift</a>
                </h6>
            </div>
            <div id="collapsible-control-group2" class="panel-collapse collapse <?php echo ($tab == 'referred') ? 'in' : ''; ?>" <?php echo ($tab == 'referred') ? 'aria-expanded="true"' : 'aria-expanded="false" style="height: 0px;"'; ?> >
                <div class="panel-body">
                    <!-- Option A -->

                    <div class="radio">
                        <label>
                            <span>
                                <input type="radio" name="referred_options" option-type="referred_discount" <?php if ($oSettings->ref_coupon_id > 0): ?> checked="checked" <?php endif; ?> class="control-primary referred_options">
                            </span>
                            Coupons Discount for Referred Customers 

                        </label>

                    </div>
                    <div class="referred_desc" id="referred-discount" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->ref_coupon_id > 0) ? 'display:block;' : 'display:none;' ?>">
                        <form name="frmReferredDiscount" id="frmReferredDiscount" method="post" data-container-id="referred-friend-gift" >
                            Give friends <input type="text" name="referred_discount" style="width:100px;padding:5px;" value="<?php echo (!empty($oSettings->referred_display_msg)) ? $oSettings->referred_display_msg : '20% off'; ?>" placeholder="e.g. 20% off" required="required" >  
                            <div class="clearfix"></div>
                            <span class="alert-danger">What message should your advocates see?</span>
                            <div class="clearfix"></div>
                            <br>
                            <br>
                            <div class="col-md-12 text-right">
                                <input type="hidden" name="rewardType" value="referred_discount" />
                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />

                                <button type="submit" class="btn bl_cust_btn bg-blue-600"> Save <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

                            </div>
                            <div class="clearfix"></div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>






                    <!-- Option B -->
                    <div class="radio">
                        <label>
                            <span>
                                <input type="radio" name="referred_options" option-type="promo" <?php if ($oSettings->promo_id > 0): ?> checked="checked" <?php endif; ?> class="control-primary referred_options" data-container-id="referred-friend-gift">
                            </span>
                            Promo Link Custom reward link for new customers

                        </label>
                    </div>
                    <div class="referred_desc" id="referred-promo" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->promo_id > 0) ? 'display:block;' : 'display:none;' ?>">
                        <form name="frmReferredPromo" id="frmReferredPromo" method="post" data-container-id="referred-friend-gift" >
                            Promo link <input type="text" name="referred_promo_link" class="form-control" style="width:200px;padding:5px;" value="<?php echo (!empty($oSettings->link_url)) ? $oSettings->link_url : ''; ?>" placeholder="e.g. http://yourstore.com/discount/link" required="required" >
                            <div class="clearfix"></div>
                            <span class="alert-danger">Add your promo link</span>
                            <div class="clearfix"></div>
                            <br>
                            Give friends <input type="text" class="form-control" name="referred_promo_desc" style="width:200px;padding:5px;" value="<?php echo (!empty($oSettings->link_desc)) ? $oSettings->link_desc : ''; ?>" placeholder="e.g. 20% off" required="required" > 
                            <div class="clearfix"></div>
                            <span class="alert-danger">Add a description for your promo link</span>
                            <div class="clearfix"></div>
                            <br>
                            Link Expiry <select class="form-control" id="promo_expiry" name="promo_expiry" style="width:200px;">
                                <option value="never" <?php echo ($oSettings->expiry == 'never') ? 'selected = "selected"' : ''; ?> >Never(Recommended)</option>
                                <option value="6" <?php echo ($oSettings->expiry == '6') ? 'selected = "selected"' : ''; ?>>6 Months</option>
                                <option value="5" <?php echo ($oSettings->expiry == '5') ? 'selected = "selected"' : ''; ?>>5 Months</option>
                                <option value="4" <?php echo ($oSettings->expiry == '4') ? 'selected = "selected"' : ''; ?>>4 Months</option>
                                <option value="3" <?php echo ($oSettings->expiry == '3') ? 'selected = "selected"' : ''; ?>>3 Months</option>
                                <option value="2" <?php echo ($oSettings->expiry == '2') ? 'selected = "selected"' : ''; ?>>2 Months</option>
                                <option value="1" <?php echo ($oSettings->expiry == '1') ? 'selected = "selected"' : ''; ?>>1 Months</option>
                                <option value="specific-date" <?php echo ($oSettings->expiry == 'specific-date') ? 'selected = "selected"' : ''; ?>>Specific Date</option>

                            </select>
                            <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="specific_expiry_picker" value="<?php echo ($oSettings->expiry_specific_date) ? $oSettings->expiry_specific_date : ''; ?>" style="width:200px;<?php echo ($oSettings->expiry == 'specific-date') ? 'display:block;' : 'display:none;'; ?>"/>

                            <br>
                            <br>
                            <div class="col-md-12 text-right">
                                <input type="hidden" name="rewardType" value="referred_promo" />
                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                <button type="submit" class="btn bl_cust_btn bg-blue-600"> Save <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

                            </div>
                            <div class="clearfix"></div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>



                    <!-- Option C -->
                    <div class="radio">
                        <label>
                            <span>
                                <input type="radio" name="referred_options" option-type="no-reward" <?php if ($oSettings->no_discount == 'yes'): ?> checked="checked" <?php endif; ?> class="control-primary referred_options">
                            </span>
                            No Reward

                        </label>
                    </div>
                    <div class="referred_desc" id="referred-no-discount" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->no_discount == 'yes') ? 'display:block;' : 'display:none;' ?>">
                        <form name="frmReferredNoDiscount" id="frmReferredNoDiscount" method="post" data-container-id="referred-friend-gift" >
                            <div class="col-md-12 text-right">
                                <input type="hidden" name="rewardType" value="referred_no_discount" />
                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />
                                <button type="submit" class="btn bl_cust_btn bg-blue-600"> Save <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

                            </div>
                            <div class="clearfix"></div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>
                </div>
            </div>
        </div> 

        <div class="panel panel-white" id="referred_coupon_details" style="display:<?php echo ($oSettings->ref_coupon_id > 0) ? 'block' : 'none'; ?>">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a data-toggle="collapse" href="#referred_coupon_codes" aria-expanded="false" id="referred-friend-coupon" <?php if ($tab != 'referred-coupons'): ?> class="collapsed" <?php endif; ?>>Add coupon codes for friends</a>
                </h6>
            </div>
            <div id="referred_coupon_codes" class="panel-collapse collapse <?php echo ($tab == 'referred-coupons') ? 'in' : ''; ?>" aria-expanded="<?php echo ($tab == 'referred-coupons') ? 'true' : 'false'; ?>" style="<?php echo ($tab == 'referred-coupons') ? '' : 'height: 0px;'; ?>">
                <div class="panel-body">



                    <!-- Option A -->

                    <div class="radio">
                        <label>
                            <span>
                                <input type="radio" name="refCouponCode" option-type="ref_single_use_coupons" <?php if ($oSettings->referred_coupon_type == 'single'): ?> checked="checked" <?php endif; ?> class="control-primary referred_options">
                            </span>
                            <strong>Single Use Coupons</strong> Unique coupon codes for every friend 

                        </label>

                    </div>
                    <div class="coupon_desc" id="referred-single-use_code" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->referred_coupon_type == 'single') ? 'display:block;' : 'display:none;' ?>">
                        <form name="frmRefSingleUseCodes" id="frmRefSingleUseCodes" method="post" data-container-id="referred-friend-coupon" >
                            Paste your coupon codes here:
                            <div class="clearfix"></div>
                            <textarea name="singleCouponCodes" rows="6" style="width:300px;padding:5px;" placeholder="list of coupon codes" ><?php
                                if (!empty($aRefCoupons)) {
                                    echo trim(implode(",", $aRefCoupons));
                                }
                                ?></textarea>

                            <br>
                            <br>
                            <div class="col-md-12 text-right">
                                <input type="hidden" name="couponType" value="referred_single_coupons" />
                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />

                                <button type="submit" class="btn bl_cust_btn bg-blue-600"> Save <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

                            </div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>






                    <!-- Option B -->
                    <div class="radio">
                        <label>
                            <span>
                                <input type="radio" name="refCouponCode" option-type="ref_multiple_use_coupons" <?php if ($oSettings->referred_coupon_type == 'multiple'): ?> checked="checked" <?php endif; ?> class="control-primary referred_options">
                            </span>
                            <strong>Multiple Use Coupons</strong> Reusable coupon code for all friends 

                        </label>

                    </div>
                    <div class="coupon_desc" id="referred-multiple-use_code" style="margin-left:10px;margin-top:15px;<?php echo ($oSettings->referred_coupon_type == 'multiple') ? 'display:block;' : 'display:none;' ?>">
                        <form name="frmRefMultipleUseCodes" id="frmRefMultipleUseCodes" method="post" data-container-id="referred-friend-coupon">
                            Paste your coupon code:
                            <div class="clearfix"></div>
                            <input type="text" class="form-control" name="multipleCouponCodes" value="<?php echo ($oAdvMultipleCoupon->coupon_code) ? $oRefMultipleCoupon->coupon_code : ''; ?>" id="multipleRefCouponCodes" placeholder="e.g. REWARD10" style="width:300px;" />
                            <div class="clearfix"></div>
                            <span class="alert-danger">Coupon Expiry</span>
                            <div class="clearfix"></div>
                            <br>
                            Coupon Expiry <select class="form-control" id="ref_coupon_expiry" name="coupon_expiry" style="width:300px;">
                                <option value="never" <?php echo ($oRefMultipleCoupon->expiry == 'never') ? 'selected = "selected"' : ''; ?> >Never(Recommended)</option>
                                <option value="6" <?php echo ($oRefMultipleCoupon->expiry == '6') ? 'selected = "selected"' : ''; ?>>6 Months</option>
                                <option value="5" <?php echo ($oRefMultipleCoupon->expiry == '5') ? 'selected = "selected"' : ''; ?>>5 Months</option>
                                <option value="4" <?php echo ($oRefMultipleCoupon->expiry == '4') ? 'selected = "selected"' : ''; ?>>4 Months</option>
                                <option value="3" <?php echo ($oRefMultipleCoupon->expiry == '3') ? 'selected = "selected"' : ''; ?>>3 Months</option>
                                <option value="2" <?php echo ($oRefMultipleCoupon->expiry == '2') ? 'selected = "selected"' : ''; ?>>2 Months</option>
                                <option value="1" <?php echo ($oRefMultipleCoupon->expiry == '1') ? 'selected = "selected"' : ''; ?>>1 Months</option>
                                <option value="specific-date" <?php echo ($oRefMultipleCoupon->expiry == 'specific-date') ? 'selected = "selected"' : ''; ?>>Specific Date</option>

                            </select>
                            <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="ref_specific_expiry_picker" value="<?php echo ($oRefMultipleCoupon->expiry_specific_date) ? $oRefMultipleCoupon->expiry_specific_date : ''; ?>" style="width:200px;<?php echo ($oRefMultipleCoupon->expiry == 'specific-date') ? 'display:block;' : 'display:none;'; ?>"/>

                            <br>
                            <br>
                            <div class="col-md-12 text-right">
                                <input type="hidden" name="couponType" value="referred_multiple_coupons" />
                                <input type="hidden" name="rewardID" value="<?php echo $oSettings->rewardID; ?>" />

                                <button type="submit" class="btn bl_cust_btn bg-blue-600"> Save <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

                            </div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>




                </div>
            </div>
        </div>


    </div>
    <?php */ ?>
    

   <!--  <div class="row pull-right">
        <div class="col-md-12">
            <a href="<?php echo base_url("/admin/modules/referral/setup/{$programID}?t=widgets") ?>" class="btn dark_btn mt30">Continue</a>
        </div>
    </div> -->

</div>


<script type="text/javascript">

    $(document).ready(function () {


        $('#addReferral').click(function () {
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/addReferral'); ?>',
                type: "POST",
                data: {'doaction': 'setupDefault'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = window.location.href;
                    }
                }
            });
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

                        //Display tag list
                        //window.location.href = '<?php echo base_url('admin/modules/referral/'); ?>?tab=referred';
                        //window.location.href = '<?php echo base_url('admin/modules/referral/'); ?>';
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
                        if(strSplitS == 'advocate_discount') {
                            $('#advocate_coupon_details_new').show();
                        }
                        else if(strSplitS == 'referred_discount') {
                            $('#referred_coupon_details_new').show();
                        }
                        else {

                        }
                    }
                }
            });
            return false;
        });


        $("#frmAdvSingleUseCodes, #frmAdvMultipleUseCodes, #frmRefSingleUseCodes, #frmRefMultipleUseCodes").submit(function () {
            var formdata = $(this).serialize();
            var elem = $(this);
            //$('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/saveCoupons'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //$('.overlaynew').hide();
                        //Display tag list
                        //window.location.href = '<?php echo base_url('admin/modules/referral/'); ?>?tab=referred';
                        //window.location.href = '<?php echo base_url('admin/modules/referral/'); ?>';
                        //window.location.href = '<?php echo base_url("/admin/modules/referral/setup/{$programID}?t=widgets") ?>';
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

        $("#promo_expiry").change(function () {
            var selectedVal = $(this).val();
            if (selectedVal == 'specific-date') {
                $("#specific_expiry_picker").show();
            } else {
                $("#specific_expiry_picker").hide();
            }
        });


        $("#adv_coupon_expiry").change(function () {
            var selectedVal = $(this).val();
            if (selectedVal == 'specific-date') {
                $("#adv_specific_expiry_picker").show();
            } else {
                $("#adv_specific_expiry_picker").hide();
            }
        });

        $("#ref_coupon_expiry").change(function () {
            var selectedVal = $(this).val();
            if (selectedVal == 'specific-date') {
                $("#ref_specific_expiry_picker").show();
            } else {
                $("#ref_specific_expiry_picker").hide();
            }
        });

    });

    $(".styled, .multiselect-container input").uniform({
        radioClass: 'choice'
    });
    $(".control-primary").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-primary-600 text-primary-800'
    });
    $('.daterange-single').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });


    $(document).ready(function() {


        $(document).on('click', '.advocateGift', function() {
            $('.advocateGift').removeClass('active_green');
            $(this).addClass('active_green');
            var optionType = $(this).attr('option-type');
            var adv_coupon_v = $('#adv_coupon_v').val();
            if(optionType == '#advocate-discount-new'){
                
                if(adv_coupon_v > 0) {
                    $('#advocate_coupon_details_new').show();
                }
                
            }
            else{
                $('#advocate_coupon_details_new').hide();
            }
            $('.advocateGiftHeading').show();
            $('.advocateGiftD').show();
            $('.advocate_desc').hide();
            $(optionType).show();
        });

        $(document).on('click', '.friendGift', function() {
            $('.friendGift').removeClass('active_green');
            $(this).addClass('active_green');
            var optionType = $(this).attr('option-type');
            var ref_coupon_v = $('#ref_coupon_v').val();
            if(optionType == '#referred-discount-new'){
                
                if(ref_coupon_v > 0) {
                    $('#referred_coupon_details_new').show();
                }
                
            }
            else{
                $('#referred_coupon_details_new').hide();
            }
            
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
        
    });


</script>





