<script type="text/javascript" src="{{ site_url() }}assets/js/plugins/pickers/anytime.min.js"></script>
<script type="text/javascript" src="{{ site_url() }}assets/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="{{ site_url() }}assets/js/plugins/pickers/pickadate/picker.date.js"></script>
@php
$tab = $this->input->get()['tab'];

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
@endphp
<!-- Content area -->
<div class="content">
    <!-- Dashboard content -->
    @if (!empty($oSettings))
        <div class="row">
            <div class="col-lg-12">
                <div class="panel-group panel-group-control content-group-lg">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a data-toggle="collapse" href="#collapsible-control-group1" aria-expanded="false" @if ($tab != 'advocate') class="collapsed" @endif >Give advocates a free gift</a>
                            </h6>
                        </div>
                        <div id="collapsible-control-group1" class="panel-collapse collapse {{ ($tab == 'advocate') ? 'in' : '' }}" aria-expanded="{{ ($tab == 'advocate') ? 'true' : 'false' }}" style="{!! ($tab == 'advocate') ? '' : 'height: 0px;' !!}">
                            <div class="panel-body">
                                <!-- Option A -->
                                <div class="radio">
                                    <label>
                                        <span>
                                            <input type="radio" name="advocate_options" option-type="discount" @if ($oSettings->adv_coupon_id > 0) checked="checked" @endif class="control-primary advocate_options">
                                        </span>
                                        Coupons Discount for Advocates 
                                    </label>
                                </div>
                                <div class="advocate_desc" id="advocate-discount" style="margin-left:10px;margin-top:15px;{!! ($oSettings->adv_coupon_id > 0) ? 'display:block;' : 'display:none' !!}">
                                    <form name="frmAdvocateDiscount" id="frmAdvocateDiscount" method="post" >
                                        Get <input type="text" name="advocate_discount" style="width:100px;padding:5px;" value="{{ (!empty($oSettings->advocate_display_msg)) ? $oSettings->advocate_display_msg : '20% off' }}" placeholder="e.g. 20% off" required="required" > for referring friends!
                                        <div class="clearfix"></div>
                                        <span class="alert-danger">What message should your advocates see?</span>
                                        <div class="clearfix"></div>
                                        <br>
                                        <span><strong>Hint:</strong>Choose either % discount or $ discount</span>
                                        <br>
                                        <br>
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="rewardType" value="advocate_discount" />
                                            <input type="hidden" name="rewardID" value="{{ $oSettings->rewardID }}" />
                                            <button type="submit" class="btn bl_cust_btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
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
                                            <input type="radio" name="advocate_options" option-type="cash" @if ($oSettings->cash_id > 0) checked="checked" @endif class="control-primary advocate_options">
                                        </span>
                                        Cash Attract one-time advocates 
                                    </label>
                                </div>
                                <div class="advocate_desc" id="advocate-cash" style="margin-left:10px;margin-top:15px;{!! ($oSettings->cash_id > 0) ? 'display:block;' : 'display:none' !!}">
                                    <form name="frmAdvocateCash" id="frmAdvocateCash" method="post" >
                                        Get <input type="text" name="advocate_cash" style="width:100px;padding:5px;" value="{{ (!empty($oSettings->display_msg)) ? $oSettings->display_msg : '$10 in cash' }}" placeholder="e.g. $10 in cash" required="required" > for referring friends!
                                        <div class="clearfix"></div>
                                        <span class="alert-danger">What message should your advocates see?</span>
                                        <div class="clearfix"></div>
                                        <br>
                                        <span><strong>Hint:</strong>Choose either % cash or $ cash</span>
                                        <br>
                                        <br>
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="rewardType" value="advocate_cash" />
                                            <input type="hidden" name="rewardID" value="{{ $oSettings->rewardID }}" />
                                            <button type="submit" class="btn bl_cust_btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

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
                                            <input type="radio" name="advocate_options" option-type="custom" @if ($oSettings->custom_id > 0) checked="checked" @endif class="control-primary advocate_options">
                                        </span>
                                        Custom Manually fulfill a custom reward 

                                    </label>
                                </div>
                                <div class="advocate_desc" id="advocate-custom" style="margin-left:10px;margin-top:15px;{!! ($oSettings->custom_id > 0) ? 'display:block;' : 'display:none;' !!}">
                                    <form name="frmAdvocateCustom" id="frmAdvocateCustom" method="post" >
                                        Get <input type="text" name="advocate_custom" style="width:100px;padding:5px;" value="{{ (!empty($oSettings->reward_title)) ? $oSettings->reward_title : 'a free gift' }}" placeholder="e.g. a free gift" required="required" > for referring friends!
                                        <div class="clearfix"></div>
                                        <span class="alert-danger">What message should your advocates see?</span>
                                        <div class="clearfix"></div>
                                        <br>
                                        <span><strong>Hint:</strong>How do custom reward works</span>
                                        <br>
                                        <br>
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="rewardType" value="advocate_custom" />
                                            <input type="hidden" name="rewardID" value="{{ $oSettings->rewardID }}" />
                                            <button type="submit" class="btn bl_cust_btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
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

                    <div class="panel panel-white" id="advocate_coupon_details" style="display:{{ ($oSettings->adv_coupon_id > 0)? 'block': 'none' }}">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a data-toggle="collapse" href="#advocate_coupon_codes" aria-expanded="false" @if ($tab != 'advocate-coupons') class="collapsed" @endif >Add coupon codes for advocates</a>
                            </h6>
                        </div>
                        <div id="advocate_coupon_codes" class="panel-collapse collapse {{ ($tab == 'advocate-coupons') ? 'in' : '' }}" aria-expanded="{{ echo ($tab == 'advocate-coupons') ? 'true' : 'false' }}" style="{{ ($tab == 'advocate-coupons') ? '' : 'height: 0px;' }}">
                            <div class="panel-body">
                                <!-- Option A -->

                                <div class="radio">
                                    <label>
                                        <span>
                                            <input type="radio" name="advCouponCode" option-type="adv_single_use_coupons" @if ($oSettings->advocate_coupon_type == 'single') checked="checked" @endif class="control-primary advocate_options">
                                        </span>
                                        <strong>Single Use Coupons</strong> Unique coupon codes for every advocate 
                                    </label>
                                </div>
                                <div class="coupon_desc" id="advocate-single-use_code" style="margin-left:10px;margin-top:15px;{{ ($oSettings->advocate_coupon_type == 'single') ? 'display:block;' : 'display:none;' }}">
                                    <form name="frmAdvSingleUseCodes" id="frmAdvSingleUseCodes" method="post" >
                                        Paste your coupon codes here:
                                        <div class="clearfix"></div>
                                        <textarea name="singleCouponCodes" rows="6" style="width:300px;padding:5px;" placeholder="list of coupon codes" >
											@php
                                            if (!empty($aAdvCoupons)) {
                                                echo trim(implode(",", $aAdvCoupons));
                                            }
                                            @endphp
											</textarea>
                                        <br>
                                        <br>
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="couponType" value="advocate_single_coupons" />
                                            <input type="hidden" name="couponID" value="{{ $oSettings->advCouponID }}" />

                                            <button type="submit" class="btn bl_cust_btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

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
                                            <input type="radio" name="advCouponCode" option-type="adv_multiple_use_coupons" @if ($oSettings->advocate_coupon_type == 'multiple') checked="checked" @endif class="control-primary advocate_options">
                                        </span>
                                        <strong>Multiple Use Coupons</strong> Reusable coupon code for all advocates 

                                    </label>

                                </div>
                                <div class="coupon_desc" id="advocate-multiple-use_code" style="margin-left:10px;margin-top:15px; {{ ($oSettings->advocate_coupon_type == 'multiple') ? 'display:block;' : 'display:none;' }}">
                                    <form name="frmAdvMultipleUseCodes" id="frmAdvMultipleUseCodes" method="post" >
                                        Paste your coupon code:
                                        <div class="clearfix"></div>
                                        <input type="text" class="form-control" name="multipleCouponCodes" value="{{ ($oAdvMultipleCoupon->coupon_code) ? $oAdvMultipleCoupon->coupon_code : '' }}" id="multipleCouponCodes" placeholder="e.g. REWARD10" style="width:300px;" />
                                        <div class="clearfix"></div>
                                        <span class="alert-danger">Coupon Expiry</span>
                                        <div class="clearfix"></div>
                                        <br>
                                        Expiry <select class="form-control" id="adv_coupon_expiry" name="coupon_expiry" style="width:300px;">
                                            <option value="never" {!! ($oAdvMultipleCoupon->expiry == 'never') ? 'selected = "selected"' : '' !!} >Never(Recommended)</option>
                                            <option value="6" {!! ($oAdvMultipleCoupon->expiry == '6') ? 'selected = "selected"' : '' !!}>6 Months</option>
                                            <option value="5" {!! ($oAdvMultipleCoupon->expiry == '5') ? 'selected = "selected"' : '' !!}>5 Months</option>
                                            <option value="4" {!! ($oAdvMultipleCoupon->expiry == '4') ? 'selected = "selected"' : '' !!}>4 Months</option>
                                            <option value="3" {!! ($oAdvMultipleCoupon->expiry == '3') ? 'selected = "selected"' : '' !!}>3 Months</option>
                                            <option value="2" {!! ($oAdvMultipleCoupon->expiry == '2') ? 'selected = "selected"' : '' !!}>2 Months</option>
                                            <option value="1" {!! ($oAdvMultipleCoupon->expiry == '1') ? 'selected = "selected"' : '' !!}>1 Months</option>
                                            <option value="specific-date" {!! ($oAdvMultipleCoupon->expiry == 'specific-date') ? 'selected = "selected"' : '' !!}>Specific Date</option>

                                        </select>
                                        <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="adv_specific_expiry_picker" value="{{ ($oAdvMultipleCoupon->expiry_specific_date) ? $oAdvMultipleCoupon->expiry_specific_date : '' }}" style="width:200px;{{ ($oAdvMultipleCoupon->expiry == 'specific-date') ? 'display:block;' : 'display:none;' }}"/>

                                        <br>
                                        <br>
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="couponType" value="advocate_multiple_coupons" />
                                            <input type="hidden" name="couponID" value="{{ $oSettings->advCouponID }}" />

                                            <button type="submit" class="btn bl_cust_btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

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
                                <a @if ($tab != 'referred'): ?> class="collapsed" @endif data-toggle="collapse" href="#collapsible-control-group2" {!! ($tab == 'referred') ? 'aria-expanded="true"' : 'aria-expanded="false"' !!} >Give referred friend a free gift</a>
                            </h6>
                        </div>
                        <div id="collapsible-control-group2" class="panel-collapse collapse {{ ($tab == 'referred') ? 'in' : '' }}" {!! ($tab == 'referred') ? 'aria-expanded="true"' : 'aria-expanded="false" style="height: 0px;"' !!} >
                            <div class="panel-body">
                                <!-- Option A -->

                                <div class="radio">
                                    <label>
                                        <span>
                                            <input type="radio" name="referred_options" option-type="referred_discount" @if ($oSettings->ref_coupon_id > 0) checked="checked" @endif class="control-primary advocate_options">
                                        </span>
                                        Coupons Discount for Referred Customers 
                                    </label>
                                </div>
                                <div class="referred_desc" id="referred-discount" style="margin-left:10px;margin-top:15px;{{ ($oSettings->ref_coupon_id > 0) ? 'display:block;' : 'display:none;' }}">
                                    <form name="frmReferredDiscount" id="frmReferredDiscount" method="post" >
                                        Give friends <input type="text" name="referred_discount" style="width:100px;padding:5px;" value="{{ (!empty($oSettings->referred_display_msg)) ? $oSettings->referred_display_msg : '20% off' }}" placeholder="e.g. 20% off" required="required" >  
                                        <div class="clearfix"></div>
                                        <span class="alert-danger">What message should your advocates see?</span>
                                        <div class="clearfix"></div>
                                        <br>
                                        <br>
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="rewardType" value="referred_discount" />
                                            <input type="hidden" name="rewardID" value="{{ $oSettings->rewardID }}" />

                                            <button type="submit" class="btn bl_cust_btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

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
                                            <input type="radio" name="referred_options" option-type="promo" @if ($oSettings->promo_id > 0) checked="checked" @endif class="control-primary referred_options">
                                        </span>
                                        Promo Link Custom reward link for new customers

                                    </label>
                                </div>
                                <div class="referred_desc" id="referred-promo" style="margin-left:10px;margin-top:15px; {{ ($oSettings->promo_id > 0) ? 'display:block;' : 'display:none;' }}">
                                    <form name="frmReferredPromo" id="frmReferredPromo" method="post" >
                                        Promo link <input type="text" name="referred_promo_link" class="form-control" style="width:200px;padding:5px;" value="{{ (!empty($oSettings->link_url)) ? $oSettings->link_url : '' }}" placeholder="e.g. http://yourstore.com/discount/link" required="required" >
                                        <div class="clearfix"></div>
                                        <span class="alert-danger">Add your promo link</span>
                                        <div class="clearfix"></div>
                                        <br>
                                        Give friends <input type="text" class="form-control" name="referred_promo_desc" style="width:200px;padding:5px;" value="{{ (!empty($oSettings->link_desc)) ? $oSettings->link_desc : '' }}" placeholder="e.g. 20% off" required="required" > 
                                        <div class="clearfix"></div>
                                        <span class="alert-danger">Add a description for your promo link</span>
                                        <div class="clearfix"></div>
                                        <br>
                                        Link Expiry <select class="form-control" id="promo_expiry" name="promo_expiry" style="width:200px;">
                                            <option value="never" {!! ($oSettings->expiry == 'never') ? 'selected = "selected"' : '' !!} >Never(Recommended)</option>
                                            <option value="6" {!! ($oSettings->expiry == '6') ? 'selected = "selected"' : '' !!}>6 Months</option>
                                            <option value="5" {!! ($oSettings->expiry == '5') ? 'selected = "selected"' : '' !!}>5 Months</option>
                                            <option value="4" {!! ($oSettings->expiry == '4') ? 'selected = "selected"' : '' !!}>4 Months</option>
                                            <option value="3" {!! ($oSettings->expiry == '3') ? 'selected = "selected"' : '' !!}>3 Months</option>
                                            <option value="2" {!! ($oSettings->expiry == '2') ? 'selected = "selected"' : '' !!}>2 Months</option>
                                            <option value="1" {!! ($oSettings->expiry == '1') ? 'selected = "selected"' : '' !!}>1 Months</option>
                                            <option value="specific-date" {!! ($oSettings->expiry == 'specific-date') ? 'selected = "selected"' : '' !!}>Specific Date</option>
                                        </select>
                                        <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="specific_expiry_picker" value="{{ ($oSettings->expiry_specific_date) ? $oSettings->expiry_specific_date : '' }}" style="width:200px;{{ ($oSettings->expiry == 'specific-date') ? 'display:block;' : 'display:none;' }}"/>

                                        <br>
                                        <br>
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="rewardType" value="referred_promo" />
                                            <input type="hidden" name="rewardID" value="{{ $oSettings->rewardID }}" />
                                            <button type="submit" class="btn bl_cust_btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
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
                                            <input type="radio" name="referred_options" option-type="no-reward" @if ($oSettings->no_discount == 'yes') checked="checked" @endif class="control-primary referred_options">
                                        </span>
                                        No Reward

                                    </label>
                                </div>
                                <div class="referred_desc" id="referred-no-discount" style="margin-left:10px;margin-top:15px;{{ ($oSettings->no_discount == 'yes') ? 'display:block;' : 'display:none;' }}">
                                    <form name="frmReferredNoDiscount" id="frmReferredNoDiscount" method="post" >
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="rewardType" value="referred_no_discount" />
                                            <input type="hidden" name="rewardID" value="{{ $oSettings->rewardID }}" />
                                            <button type="submit" class="btn bl_cust_btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

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
                    
                     <div class="panel panel-white" id="referred_coupon_details" style="display:{{ ($oSettings->ref_coupon_id > 0)? 'block': 'none' }}">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a data-toggle="collapse" href="#referred_coupon_codes" aria-expanded="false" @if ($tab != 'referred-coupons') class="collapsed" @endif >Add coupon codes for friends</a>
                            </h6>
                        </div>
                        <div id="referred_coupon_codes" class="panel-collapse collapse {{ ($tab == 'referred-coupons') ? 'in' : '' }}" aria-expanded="{{ ($tab == 'referred-coupons') ? 'true' : 'false' }}" style="{{ ($tab == 'referred-coupons') ? '' : 'height: 0px;' }}">
                            <div class="panel-body">
                                <!-- Option A -->

                                <div class="radio">
                                    <label>
                                        <span>
                                            <input type="radio" name="refCouponCode" option-type="ref_single_use_coupons" @if ($oSettings->referred_coupon_type == 'single') checked="checked" @endif class="control-primary advocate_options">
                                        </span>
                                        <strong>Single Use Coupons</strong> Unique coupon codes for every friend 

                                    </label>

                                </div>
                                <div class="coupon_desc" id="referred-single-use_code" style="margin-left:10px;margin-top:15px; {{ ($oSettings->referred_coupon_type == 'single') ? 'display:block;' : 'display:none;' }}">
                                    <form name="frmRefSingleUseCodes" id="frmRefSingleUseCodes" method="post" >
                                        Paste your coupon codes here:
                                        <div class="clearfix"></div>
                                        <textarea name="singleCouponCodes" rows="6" style="width:300px;padding:5px;" placeholder="list of coupon codes" >
											@php
                                            if (!empty($aRefCoupons)) {
                                                echo trim(implode(",", $aRefCoupons));
                                            }
                                            @endphp
											</textarea>
                                        <br>
                                        <br>
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="couponType" value="referred_single_coupons" />
                                            <input type="hidden" name="couponID" value="{{ $oSettings->refCouponID }}" />

                                            <button type="submit" class="btn bl_cust_btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>

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
                                            <input type="radio" name="refCouponCode" option-type="ref_multiple_use_coupons" @if ($oSettings->referred_coupon_type == 'multiple') checked="checked" @endif class="control-primary referred_options">
                                        </span>
                                        <strong>Multiple Use Coupons</strong> Reusable coupon code for all friends 

                                    </label>

                                </div>
                                <div class="coupon_desc" id="referred-multiple-use_code" style="margin-left:10px;margin-top:15px; {{ ($oSettings->referred_coupon_type == 'multiple') ? 'display:block;' : 'display:none;' }}">
                                    <form name="frmRefMultipleUseCodes" id="frmRefMultipleUseCodes" method="post" >
                                        Paste your coupon code:
                                        <div class="clearfix"></div>
                                        <input type="text" class="form-control" name="multipleCouponCodes" value="{{ ($oAdvMultipleCoupon->coupon_code) ? $oRefMultipleCoupon->coupon_code : '' }}" id="multipleRefCouponCodes" placeholder="e.g. REWARD10" style="width:300px;" />
                                        <div class="clearfix"></div>
                                        <span class="alert-danger">Coupon Expiry</span>
                                        <div class="clearfix"></div>
                                        <br>
                                        Coupon Expiry <select class="form-control" id="ref_coupon_expiry" name="coupon_expiry" style="width:300px;">
                                            <option value="never" {!! ($oRefMultipleCoupon->expiry == 'never') ? 'selected = "selected"' : '' !!} > Never(Recommended)</option>
                                            <option value="6" {!! ($oRefMultipleCoupon->expiry == '6') ? 'selected = "selected"' : '' !!}>6 Months</option>
                                            <option value="5" {!! ($oRefMultipleCoupon->expiry == '5') ? 'selected = "selected"' : '' !!}>5 Months</option>
                                            <option value="4" {!! ($oRefMultipleCoupon->expiry == '4') ? 'selected = "selected"' : '' !!}>4 Months</option>
                                            <option value="3" {!! ($oRefMultipleCoupon->expiry == '3') ? 'selected = "selected"' : '' !!}>3 Months</option>
                                            <option value="2" {!! ($oRefMultipleCoupon->expiry == '2') ? 'selected = "selected"' : '' !!}>2 Months</option>
                                            <option value="1" {!! ($oRefMultipleCoupon->expiry == '1') ? 'selected = "selected"' : '' !!}>1 Months</option>
                                            <option value="specific-date" {!! ($oRefMultipleCoupon->expiry == 'specific-date') ? 'selected = "selected"' : '' !!}>Specific Date</option>

                                        </select>
                                        <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="ref_specific_expiry_picker" value="{{ ($oRefMultipleCoupon->expiry_specific_date) ? $oRefMultipleCoupon->expiry_specific_date : '' }}" style="width:200px;{{ ($oRefMultipleCoupon->expiry == 'specific-date') ? 'display:block;' : 'display:none;' }}"/>

                                        <br>
                                        <br>
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="couponType" value="referred_multiple_coupons" />
                                            <input type="hidden" name="couponID" value="{{ $oSettings->refCouponID }}" />
                                            <button type="submit" class="btn bl_cust_btn bg-blue-600"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
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
            </div>
        </div>
	@else
        <div class="row">
            <div class="col-md-12">
                <div style="margin: 200px 0px 0;" class="text-center">
                    <h5 class="mb-20">
                        Just a few steps and you'll be ready to launch your referral program 💪 
                    </h5>
                    <button @if ($bActiveSubsription == false) title="Get Started" class="btn bl_cust_btn btn-default pDisplayNoActiveSubscription" @else id="addReferral" @endif class="btn bl_cust_btn mb-10 btn-default addReferral" type="button"><i class="icon-make-group position-left"></i> Get started</button>
                </div>
            </div>
        </div>
	@endif
    <!-- /dashboard content -->

</div>
<!-- /content area -->


<script type="text/javascript">

    $(document).ready(function () {
        $('#addReferral').click(function () {
            $('.overlaynew').show();
            $.ajax({
                url: "{{ base_url('admin/modules/referral/addReferral') }}",
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
              $("#advocate_coupon_details").hide();
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
                $(".referred_desc").hide();
                $("#referred-discount").show();
            } else if (selectedOption == "promo") {
                $(".referred_desc").hide();
                $("#referred-promo").show();
            } else if (selectedOption == "no-reward") {
                $(".referred_desc").hide();
                $("#referred-no-discount").show();

            }else if (selectedOption == "adv_single_use_coupons") {
                $(".coupon_desc").hide();
                $("#advocate-single-use_code").show();
                $("#advocate_coupon_details").show();

            }else if (selectedOption == "adv_multiple_use_coupons") {
                $(".coupon_desc").hide();
                $("#advocate-multiple-use_code").show();
                $("#advocate_coupon_details").show();

            }else if (selectedOption == "ref_single_use_coupons") {
                $(".coupon_desc").hide();
                $("#referred-single-use_code").show();
                $("#referred_coupon_details").show();

            }else if (selectedOption == "ref_multiple_use_coupons") {
                $(".coupon_desc").hide();
                $("#referred-multiple-use_code").show();
                $("#referred_coupon_details").show();

            }
        });
		

        $("#frmAdvocateDiscount, #frmAdvocateCash, #frmAdvocateCustom, #frmReferredDiscount, #frmReferredPromo, #frmReferredNoDiscount").submit(function () {
            var formdata = $(this).serialize();
            $.ajax({
                url: "{{ base_url('admin/modules/referral/saveRewards') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = "{{ base_url('admin/modules/referral/') }}";
                    }
                }
            });
            return false;
        });
        
        
        $("#frmAdvSingleUseCodes, #frmAdvMultipleUseCodes, #frmRefSingleUseCodes, #frmRefMultipleUseCodes").submit(function () {
            var formdata = $(this).serialize();
            $.ajax({
                url: "{{ base_url('admin/modules/referral/saveCoupons') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = "{{ base_url('admin/modules/referral/') }}";
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
</script>