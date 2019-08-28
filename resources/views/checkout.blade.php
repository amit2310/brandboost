@extends('layouts.front_template') 

@section('contents')
<!--=====================price box=========================-->
<style type="text/css">
    #card{
        background-position: 0px -35px !important;
        width: 52px!important;
        height: 35px!important;
        top: 7px!important;
        right: 22px!important;
    }
    .visa{
        background-image: url('<?php echo base_url(); ?>assets/images/visa.png');
    }
    .mastercard{
        background-image: url('<?php echo base_url(); ?>assets/images/master.png');
    }
    .discover{
        background-image: url('<?php echo base_url(); ?>assets/images/discover.png');
    }
    .amex{
        background-image: url('<?php echo base_url(); ?>assets/images/amex.png');
    }

</style>
<!-- <script type="text/javascript" src="<?php //echo base_url('assets/js/creditCardValidator.js');            ?>"></script> -->
<!--<script type="text/javascript" src="<?php echo base_url('assets/js/maskedinput.js'); ?>"></script>-->
<section class="top_text checkout">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="top_bar">
                    <div class="col-md-4"><p style="padding-left:45px;"><i class="fa hidden fa-check"></i> Create Account</p></div>
                    <div class="col-md-4"><p><i class="fa hidden fa-check"></i> Install Brand Boost On Your Web Site</p></div>
                    <div class="col-md-4 active"><p><i class="fa hidden fa-check"></i>  Confirm My Account</p></div>
                </div>
            </div>
            <div class="col-md-12">
                <h1>Please Confirm Your Account</h1>
                <?php if (@($membership_data->free_trial_days > 0)): ?>
                    <h3>We use this info for account verification, your card will not be <br>
                        charged for <?php echo $membership_data->free_trial_days; ?> days and you can cancel at any time.

                    </h3>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white_box">
                    <div class="row">
                        <!--========Left Checkout Form=========-->
                        <div class="col-md-7">
                            <div class="checkout_left">
                                <div id="newCreditCardForm">
                                    <div class="alert-danger" style="margin-bottom:10px;"></div>
                                    <form action="<?php echo base_url('/payment/charging'); ?>"  method="post" id="frmSubmit">
                                        @csrf
                                        <input type="hidden" name="plan_id" class="plan_id" value="<?php echo $plan_id; ?>" />
                                        <input type="hidden" name="isUniqueAccount" id="isUniqueAccount" value="false" />
<!--                                        <input type="hidden" name="contact_id" value="<?php echo Session::get('user_user_id'); ?>" />-->
                                        <div class="row">

                                            <div class="col-md-12">
                                                <h4>PERSONAL INFORMATION</h4>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="input_box">
                                                    <label>First name</label>
                                                    <input type="text" name="firstname" value="<?php echo @($aUser->firstname); ?>" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input_box">
                                                    <label>Last name</label>
                                                    <input type="text" name="lastname" value="<?php echo @($aUser->lastname); ?>"  required/>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="input_box">
                                                    <label>Email</label>
                                                    <input type="text" name="email" id="email" value="<?php echo @($aUser->email); ?>" required/>
                                                    <div style="color: red;" id="msgEmail"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input_box">
                                                    <label>Postal Code</label>
                                                    <input type="text" name="postal_code" class="txtboxToFilter"  value="" placeholder="10001" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input_box">
                                                    <label>Phone Number</label>
                                                    <input type="text" name="phone_number" value="" class="txtboxToFilter" placeholder="(212) 692-93-92" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mtop20">
                                                <h4>PAYMENTS DETAILS <i class="fa fa-lock"></i></h4>
                                            </div>

                                            <div class="col-md-12">

                                                <div id="card" class="visa"></div>
                                                <div class="input_box">
                                                    <label>Credit Card Number:</label>
                                                    <input class="" id="cardNumber" name="cardNumber" autocomplete="off" maxlength="16" type="text" value="" required onkeypress="return isNumber(event);">
                                                    <div style="color: red;" id="msgCard"></div>

                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="input_box">
                                                    <div class="help"><img src="<?php echo base_url(); ?>assets/images/help.png"/></div>
                                                    <label>Security code</label>
                                                    <input type="text" name="creditCardVerificationNumber" maxlength="3" value="" class="txtboxToFilter" placeholder="***" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="input_box">
                                                    <label>Exp Month</label>
                                                    <select name="creditCardExpirationMonth" class="txtboxToFilter" required >
                                                        <option value="">MM</option>
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                        <option value="05">05</option>
                                                        <option value="06">06</option>
                                                        <option value="07">07</option>
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="input_box">
                                                    <label>Exp year</label>
                                                    <select name="creditCardExpirationYear" class="txtboxToFilter" required >
                                                        <option value="">YYYY</option>
                                                        <?php for ($i = date('Y'); $i <= date('Y', strtotime('+20 years')); $i++) { ?>  
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="text-align:left; margin-bottom:20px;">
                                                <input type="checkbox" name="saveCard" value="1"> Save my credit card for future purchases.
                                            </div>
                                            <div class="col-md-12">
                                                <button style="display: none;" id="confirmSub" class="btn-orange" type="submit"><span>&nbsp; &nbsp;<i class="fa fa-cart-plus"></i>&nbsp; CONFIRM ORDER</span></button>

                                                <button class="btn-orange" id="confirmBut" type="submit"><span>&nbsp; &nbsp;<i class="fa fa-cart-plus"></i>&nbsp; CONFIRM ORDER</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--========Right Checkout Form=========-->
                        <div class="col-md-5">
                            <div class="what_include pull-right">

                                <?php
                                if (!empty($membership_data)) {
                                    ?>

                                    <h4><?php echo $membership_data->level_name; ?></h4>

                                    <ul>
                                        <li><?php echo number_format($membership_data->sms_limit); ?> SMS invites included per month</li>
                                        <li>You can buy SMS packs at 100, 250, 500, 1,000 SMS packs (price to be determined for each pack size)</li>
                                        <li><?php echo number_format($membership_data->email_limit); ?> Email Invites Included per month</li>
                                        <li>You can buy email packs at 100, 250, 500, and 1,000 email credits)</li>
                                        <li>Text reviews on web site (<?php echo number_format($membership_data->text_review_limit); ?> displayed per month)</li>
                                        <li>Video reviews on web site (<?php echo number_format($membership_data->video_review_limit); ?> displayed per month)</li>
                                        <li><?php echo $membership_data->social_invite_sources; ?></li>
                                        <li>"add your own" allowed as well</li>
                                    </ul>

                                    <hr>




                                    <?php
                                    if ($plan == 'monthly') {
                                        ?>
                                        <p><strong>Plan: Pro</strong> <span>
                                                <?php if (@($membership_data->free_trial_days > 0)): ?>
                                                    <?php echo @($membership_data->free_trial_days) . ' Days Free and thereafter ' . "<br>"; ?>
                                                <?php endif; ?>
                                                $<?php echo number_format($membership_data->price, 2); ?> / Month</span></p>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <h2><strong>Total</strong> 
                                            <span>
                                                <?php if (@($membership_data->free_trial_days > 0)): ?>
                                                    $0.00
                                                <?php else: ?>
                                                    $<?php echo number_format($membership_data->price, 2); ?>
                                                <?php endif; ?>
                                            </span></h2>
                                        <?php if (@($membership_data->free_trial_days > 0)): ?>
                                            (After free trial, $<?php echo number_format($membership_data->price, 2); ?>/Month)
                                        <?php endif; ?>

                                        <?php
                                    } else {
                                        ?>
                                        <p><strong>Price Yearly</strong> <span>$<?php echo number_format($membership_data->price, 2); ?> / Yearly</span></p>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <h2><strong>Total</strong> <span>$<?php echo number_format($membership_data->price, 2); ?></span></h2><?php
                                    }
                                }
                                ?>
                                <div class="clearfix"></div>

                            </div>
                            <div class="text-center"><img src="<?php echo base_url(); ?>assets/images/mcafee.jpg"/></div>
                        </div>
                        <!--========Right Checkout Form end=========-->

                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<script type="text/javascript">

    $(document).ready(function () {

        $("#frmSubmit").submit(function () {
            if ($("#isUniqueAccount").val() == "true") {
                return true;
            } else {
                $("#email").trigger("blur");
                return false;
            }

        });
        $("#cardNumber").on("keyup", function () {
            $("#cardNumber").css('border', 'none');
            $("#msgCard").hide();
            $("#msgCard").html('');

        });
        $("#cardNumber").blur(function () {
            var str = $(this).val();
            if (str.length > 0) {
                if (str.length < 16) {
                    $("#msgCard").css('border', '1px solid red');
                    $("#msgCard").show();
                    $("#msgCard").html('Invalid Credit Card Number');
                }
            }
        });

        $("#email").on("keyup", function () {
            $("#email").css('border', 'none');
            $("#msgEmail").hide();
            $("#msgEmail").html('');
            $("#confirmBut").hide();
            $("#confirmSub").show();
        });

        $("#email").blur(function (e) {
            var str = $(this).val();
            if (str.length > 0) {
                var isValidated = validation();
                if (isValidated == true) {
                    $.ajax({
                        url: "<?php echo base_url('admin/users/checkEmailExist'); ?>",
                        type: "POST",
                        data: {_token: '{{csrf_token()}}', emailID: str},
                        dataType: "json",
                        success: function (data) {

                            console.log(data);
                            if (data.status == 'success') {
                                $("#isUniqueAccount").val("false");
                                $("#email").css('border', '1px solid red');
                                $("#msgEmail").show();
                                $("#msgEmail").html('Email already exist. Please login into your account');
                                $("#confirmSub").hide();
                                $("#confirmBut").show();

                            } else {
                                $("#isUniqueAccount").val("true");
                                $("#email").css('border', 'none');
                                $("#msgEmail").hide();
                                $("#msgEmail").html('');
                                $("#confirmBut").hide();
                                $("#confirmSub").show();
                            }
                        }
                    });

                } else {
                    $("#email").css('border', '1px solid red');
                    $("#msgEmail").show();
                    $("#msgEmail").html('Please enter valid email address');
                }
            }
        });

    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    function validation() {

        var sEmail = $("#email").val();
        var flag = 1;
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {

            $("#email").css('border', 'none');
        } else {
            $("#email").css('border', '1px solid red');
            flag = 0;
        }

        if (flag == 1) {

            return true;
        } else {

            return false;
        }
    }

    $(document).ready(function () {
        $(".txtboxToFilter").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
    });</script>

@endsection