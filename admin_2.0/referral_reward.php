<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Brand Boost 2.0</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="icon" href="assets/images/icon.ico" sizes="16x16" type="image/ico">


 <!--******************
 CSS
 **********************-->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.3.0/fonts/remixicon.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link href="assets/css/styleguide.css" rel="stylesheet" type="text/css">
<style>
	.form-group label {
	letter-spacing: 0.04em;
	text-transform: uppercase;
	color: #687693!important;
	font-size: 10px!important
	}
	.email_config_list li{width: 19.5%}
	.card{width: 100%}
	

	
	
	</style>
</head>
<body id="EmailSection">

<div class="page-wrapper"> 
  <!--******************
 SIDEBAR
 **********************-->
  <?php include("sidebar.php"); ?>
  <div class="page-content"> 
    <!--******************
  TOPBAR
 **********************-->
    <?php include("topbar.php"); ?>
    
    <!--******************
  Top Heading area
 **********************-->
    <div class="top-bar-top-section bbot">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6"> <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
            <h3 class="htxt_medium_24 dark_700">New Referral Campaign </h3>
          </div>
          <div class="col-md-6 text-right">
            <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20"> Save as draft </button>
            <button class="btn btn-md bkg_email_300 light_000 slidebox"> Publish <span style="opacity: 1"><img src="assets/images/arrow-right-line-white.svg"/></span></button>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    
    <!--******************
  Content Area
 **********************-->
    <div class="content-area">
      <div class="container-fluid">
        <div class="table_head_action">
          <div class="row">
            <div class="col-md-12">
              <ul class="email_config_list">
                <li><a class="done" href="#"><span class="num_circle"><span class="num">1</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Select Source</a></li>
                <li><a class="active" href="#"><span class="num_circle"><span class="num">2</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Rewards</a></li>
                <li><a href="#"><span class="num_circle"><span class="num">3</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Email Workflow</a></li>
                <li><a href="#"><span class="num_circle"><span class="num">4</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Configuration</a></li>
                <li><a href="#"><span class="num_circle"><span class="num">5</span><span class="check_img"><img src="assets/images/email_check.svg"/></span></span>Summary</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p class="fw400 fsize15 dark_300">Advocates Reward</p>
          </div>
        </div>
        <div class="row mb30">
          <div class="col-md-4 text-center">
            <label for="temp1" class="m0 w-100">
            <div class="broadcast_select_contact ref">
              <label class="custmo_checkbox">
                <input class="check" type="checkbox" id="temp1" checked="">
                <span class="custmo_checkmark green_tr"></span> </label>
              <div class="img_box img_inactive" style="display: none;"> <img src="http://brandboost.io/assets/images/ref_reward_1.png"> </div>
              <div class="img_box img_active " style="display: block;"> <img src="http://brandboost.io/assets/images/ref_reward_1_act.png"> </div>
              <p class="fsize14 txt_dark fw500">Coupon</p>
              <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
            </div>
            </label>
          </div>
          <div class="col-md-4 text-center">
            <label for="temp2" class="m0 w-100">
            <div class="broadcast_select_contact ref">
              <label class="custmo_checkbox">
                <input class="check" type="checkbox" id="temp2">
                <span class="custmo_checkmark green_tr"></span> </label>
              <div class="img_box img_inactive" style="display: block;"> <img src="http://brandboost.io/assets/images/ref_reward_2.png"> </div>
              <div class="img_box img_active " style="display: none;"> <img src="http://brandboost.io/assets/images/ref_reward_2_act.png"> </div>
              <p class="fsize14 txt_dark fw500">Cash</p>
              <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
            </div>
            </label>
          </div>
          <div class="col-md-4 text-center">
            <label for="temp3" class="m0 w-100">
            <div class="broadcast_select_contact ref">
              <label class="custmo_checkbox">
                <input class="check" type="checkbox" id="temp3" >
                <span class="custmo_checkmark green_tr"></span> </label>
              <div class="img_box img_inactive" style="display: block;"> <img src="http://brandboost.io/assets/images/ref_reward_3.png"> </div>
              <div class="img_box img_active " style="display: none;"> <img src="http://brandboost.io/assets/images/ref_reward_3_act.png"> </div>
              <p class="fsize14 txt_dark fw500">Custom</p>
              <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
            </div>
            </label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card p40 min_h_240">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="htxt_bold_16 dark_700 mb10">Gift Configuration</h3>
                  <p class="fsize12 fw300 dark_300 mb20">This text will be displayed in the ‘Subject’ field in your recepient’s email client.</p>
                  <hr>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Amount</label>
                    <div class="">
                      <input type="hidden" name="rewardType" value="advocate_discount">
                      <input name="advocate_discount_price" class="form-control" type="text" value="12" required="" placeholder="10">
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label class="control-label">&nbsp;</label>
                    <div class=""> 
                      <!--<div class="input-group">
									<input type="hidden" name="advocate_discount_type" class="form-control advocate_discount_type" value="percent" placeholder="%">
									<input type="text" name="" value="%" id="adCouponVal" class="form-control" readonly="">
									<span style="display: none;" class="input-group-addon bkg_dgreen bor_n adCouponType" amtsign="%" amttext="percent"><i class="icon-percent txt_white"></i></span>
									<span style="display: table-cell;" class="input-group-addon bkg_dgreen bor_n adCouponType" amtsign="$" amttext="dollar"><i class="icon-coin-dollar txt_white"></i></span>
								</div>-->
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="%" id="demo" name="email">
                        <div class="input-group-append"> <span class="input-group-text">$</span> </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="control-label">Reward Message</label>
                    <div class="">
                      <input type="text" name="advocate_discount" class="form-control" value="12% off" placeholder="e.g. 20% off" required="required">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card border p20 bkg_light_050 shadow-none mt30 mb0">
                <div class="radio">
                  <label> <span class="float-left" style="margin: 2px 8px 0 0">
                    <input type="radio" name="advCouponCode" option-type="adv_single_use_coupons" class="control-primary advocate_options">
                    </span> <strong>Single Use Coupons</strong> Unique coupon codes for every advocate </label>
                </div>
                <div class="coupon_desc p20" id="advocate-single-use_code" style="display: block;">
                  <form name="frmAdvSingleUseCodes" id="frmAdvSingleUseCodes" data-container-id="advocate-coupon-details" method="post">
                    <div class="row">
                      <div class="col-md-10">
                        <div class="form-group">
                          <label class="control-label">Paste your coupon codes here</label>
                          <div class="">
                            <textarea name="singleCouponCodes" class="form-control fsize13 p20" placeholder="list of coupon codes" required></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 text-right">
                        <div class="form-group">
                          <label class="control-label">&nbsp;</label>
                          <div>
                            <input type="hidden" name="couponType" value="advocate_single_coupons">
                            <input type="hidden" name="rewardID" value="25">
                            <button type="submit" class="btn btn-md bkg_email_300 light_000 pl20 pr20 singleCouponCodesSubmit">Save Changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="radio">
                  <label> <span class="float-left" style="margin: 2px 8px 0 0">
                    <input type="radio" name="advCouponCode" option-type="adv_multiple_use_coupons" checked="checked" class="control-primary advocate_options">
                    </span> <strong>Multiple Use Coupons</strong> Reusable coupon code for all advocates </label>
                </div>
                <div class="coupon_desc p20" id="advocate-multiple-use_code" style="display: block;">
                  <form name="frmAdvMultipleUseCodes" id="frmAdvMultipleUseCodes" data-container-id="advocate-coupon-details" method="post">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Paste your coupon code</label>
                          <div class="">
                            <input type="text" class="form-control" name="multipleCouponCodes" value="Test1" id="multipleCouponCodes" placeholder="e.g. REWARD10">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Expiry</label>
                          <div class="">
                            <select class="form-control" id="adv_coupon_expiry" name="coupon_expiry">
                              <option value="never">Never(Recommended)</option>
                              <option value="6" selected="selected">6 Months</option>
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
                            <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="adv_specific_expiry_picker" value="" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 text-right">
                        <div class="form-group">
                          <label class="control-label">&nbsp;</label>
                          <div>
                            <input type="hidden" name="couponType" value="advocate_multiple_coupons">
                            <input type="hidden" name="rewardID" value="25">
                            <button type="submit" class="btn btn-md bkg_email_300 light_000 pl20 pr20  multipalCouponCodesSubmit"><span>Save Changes</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p class="fw400 fsize15 dark_300">Friends Reward</p>
          </div>
        </div>
        <div class="row mb30">
          <div class="col-md-4 text-center">
            <label for="temp4" class="m0 w-100">
            <div class="broadcast_select_contact ref">
              <label class="custmo_checkbox">
                <input class="check" type="checkbox" id="temp4" checked="">
                <span class="custmo_checkmark green_tr"></span> </label>
              <div class="img_box img_inactive" style="display: none;"> <img src="http://brandboost.io/assets/images/ref_reward_1.png"> </div>
              <div class="img_box img_active " style="display: block;"> <img src="http://brandboost.io/assets/images/ref_reward_1_act.png"> </div>
              <p class="fsize14 txt_dark fw500">Coupon</p>
              <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
            </div>
            </label>
          </div>
          <div class="col-md-4 text-center">
            <label for="temp5" class="m0 w-100">
            <div class="broadcast_select_contact ref">
              <label class="custmo_checkbox">
                <input class="check" type="checkbox" id="temp5">
                <span class="custmo_checkmark green_tr"></span> </label>
              <div class="img_box img_inactive" style="display: block;"> <img src="http://brandboost.io/assets/images/ref_reward_2.png"> </div>
              <div class="img_box img_active " style="display: none;"> <img src="http://brandboost.io/assets/images/ref_reward_2_act.png"> </div>
              <p class="fsize14 txt_dark fw500">Cash</p>
              <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
            </div>
            </label>
          </div>
          <div class="col-md-4 text-center">
            <label for="temp6" class="m0 w-100">
            <div class="broadcast_select_contact ref">
              <label class="custmo_checkbox">
                <input class="check" type="checkbox" id="temp6" >
                <span class="custmo_checkmark green_tr"></span> </label>
              <div class="img_box img_inactive" style="display: block;"> <img src="http://brandboost.io/assets/images/ref_reward_3.png"> </div>
              <div class="img_box img_active " style="display: none;"> <img src="http://brandboost.io/assets/images/ref_reward_3_act.png"> </div>
              <p class="fsize14 txt_dark fw500">Custom</p>
              <p class="fsize12 txt_grey fw300">Coupon discount for advocate</p>
            </div>
            </label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card p40 min_h_240">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="htxt_bold_16 dark_700 mb10">Gift Configuration</h3>
                  <p class="fsize12 fw300 dark_300 mb20">This text will be displayed in the ‘Subject’ field in your recepient’s email client.</p>
                  <hr>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Amount</label>
                    <div class="">
                      <input type="hidden" name="rewardType" value="advocate_discount">
                      <input name="advocate_discount_price" class="form-control" type="text" value="12" required="" placeholder="10">
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label class="control-label">&nbsp;</label>
                    <div class=""> 
                      <!--<div class="input-group">
									<input type="hidden" name="advocate_discount_type" class="form-control advocate_discount_type" value="percent" placeholder="%">
									<input type="text" name="" value="%" id="adCouponVal" class="form-control" readonly="">
									<span style="display: none;" class="input-group-addon bkg_dgreen bor_n adCouponType" amtsign="%" amttext="percent"><i class="icon-percent txt_white"></i></span>
									<span style="display: table-cell;" class="input-group-addon bkg_dgreen bor_n adCouponType" amtsign="$" amttext="dollar"><i class="icon-coin-dollar txt_white"></i></span>
								</div>-->
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="%" id="demo" name="email">
                        <div class="input-group-append"> <span class="input-group-text">$</span> </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="control-label">Reward Message</label>
                    <div class="">
                      <input type="text" name="advocate_discount" class="form-control" value="12% off" placeholder="e.g. 20% off" required="required">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card border p20 bkg_light_050 shadow-none mt30 mb0">
                <div class="radio">
                  <label> <span class="float-left" style="margin: 2px 8px 0 0">
                    <input type="radio" name="advCouponCode" option-type="adv_single_use_coupons" class="control-primary advocate_options">
                    </span> <strong>Single Use Coupons</strong> Unique coupon codes for every advocate </label>
                </div>
                <div class="coupon_desc p20" id="advocate-single-use_code" style="display: block;">
                  <form name="frmAdvSingleUseCodes" id="frmAdvSingleUseCodes" data-container-id="advocate-coupon-details" method="post">
                    <div class="row">
                      <div class="col-md-10">
                        <div class="form-group">
                          <label class="control-label">Paste your coupon codes here</label>
                          <div class="">
                            <textarea name="singleCouponCodes" class="form-control fsize13 p20" placeholder="list of coupon codes" required></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 text-right">
                        <div class="form-group">
                          <label class="control-label">&nbsp;</label>
                          <div>
                            <input type="hidden" name="couponType" value="advocate_single_coupons">
                            <input type="hidden" name="rewardID" value="25">
                            <button type="submit" class="btn btn-md bkg_email_300 light_000 pl20 pr20 singleCouponCodesSubmit">Save Changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="radio">
                  <label> <span class="float-left" style="margin: 2px 8px 0 0">
                    <input type="radio" name="advCouponCode" option-type="adv_multiple_use_coupons" checked="checked" class="control-primary advocate_options">
                    </span> <strong>Multiple Use Coupons</strong> Reusable coupon code for all advocates </label>
                </div>
                <div class="coupon_desc p20" id="advocate-multiple-use_code" style="display: block;">
                  <form name="frmAdvMultipleUseCodes" id="frmAdvMultipleUseCodes" data-container-id="advocate-coupon-details" method="post">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Paste your coupon code</label>
                          <div class="">
                            <input type="text" class="form-control" name="multipleCouponCodes" value="Test1" id="multipleCouponCodes" placeholder="e.g. REWARD10">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Expiry</label>
                          <div class="">
                            <select class="form-control" id="adv_coupon_expiry" name="coupon_expiry">
                              <option value="never">Never(Recommended)</option>
                              <option value="6" selected="selected">6 Months</option>
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
                            <input type="text" name="specific_expiry_picker" class="form-control daterange-single" id="adv_specific_expiry_picker" value="" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 text-right">
                        <div class="form-group">
                          <label class="control-label">&nbsp;</label>
                          <div>
                            <input type="hidden" name="couponType" value="advocate_multiple_coupons">
                            <input type="hidden" name="rewardID" value="25">
                            <button type="submit" class="btn btn-md bkg_email_300 light_000 pl20 pr20  multipalCouponCodesSubmit"><span>Save Changes</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt40">
          <div class="col-md-12">
            <hr class="mb25">
          </div>
          <div class="col-6">
            <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"> <span class="ml0 mr10"><img src="assets/images/arrow-left-line.svg"></span>Back</button>
          </div>
          <div class="col-6">
            <button class="btn btn-sm bkg_email_300 light_000 float-right">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button>
          </div>
        </div>
      </div>
    </div>
    
    <!--******************
  Content Area End
 **********************--> </div>
</div>
  
  
 
 
 
 
 
 

 <!--******************
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/app.js"></script>
<script>
	//side nav active script
	$(".nav-link.email").addClass("active");
	$(".nav-link.people").removeClass("active");
	$(".main-icon-menu-pane.email").addClass("active");
	$(".main-icon-menu-pane.people").removeClass("active");
	
	
	
	$('.check').change(function(){
	if($(this).prop("checked")){
		$(this).parent().parent().find(".img_inactive").hide();
		$(this).parent().parent().find(".img_active").show();
	}else{
		$(this).parent().parent().find(".img_inactive").show();
		$(this).parent().parent().find(".img_active").hide();
	}
	
}) 
</script>
</body>
</html>