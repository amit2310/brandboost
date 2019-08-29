{{ $countriesList = getCountriesList() }}

<div id="alertMessagePopup" style="z-index: 9999999999" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="message"></div>
            </div>
            <div class="modal-footer">
                <button data-bb-handler="confirm" type="button" class="btn btn-primary confirmOk">OK</button>
            </div>
        </div>
    </div>
</div>

<div id="viewNotActivePlanModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Subscription Alert</h5>
            </div>
            <div class="modal-body">
                <div class="col-md-12">Your subscription plan in not active</div>
                &nbsp;
            </div>

            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
            </div>
        </div>
    </div>
</div>


<div id="upgrade_popup1_old" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-top: 3px solid #0ea0dd">
            <div class="modal-header mb-20 text-center">
                <button style="top: 20px;" type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 style="font-size: 35px;  font-style: italic; margin:30px 0 0;">
                    <strong>Upgrade to 
                        @if (isset($oUpgradePlanData->level_name))
                            {{ $oUpgradePlanData->level_name }}
                        @endif
                    </strong>
                </h1>
                <h2 class="modal-title">Get these amazing features:</h2>
            </div>

            <div class="modal-body ptb80 mt-20 mb-20">
                <div class="row">
                    <div class="col-md-6 text-center"><img src="{{ URL::asset('assets/images/upgrade1.jpg') }}"/>
                    </div>

                    <div class="col-md-6">
                        <div class="content-group mt-15">
                            <dl>
                                <dt class="text-size-small text-bold text-uppercase">
                                    <i class="icon-checkmark3 text-blue position-left"></i>
                                    Email Invites
                                </dt>

                                <dd>Total Email Invites :
                                    @if (isset($oUpgradePlanData->email_limit))
                                        {{ $oUpgradePlanData->email_limit }}
                                    @endif
                                </dd>

                                <dt class="text-size-small text-bold text-uppercase">
                                    <i class="icon-checkmark3 text-blue position-left"></i>
                                    Sms Invites
                                </dt>

                                <dd>Total Sms Invites :
                                    @if (isset($oUpgradePlanData->sms_limit))
                                        {{ $oUpgradePlanData->sms_limit }}
                                    @endif
                                </dd>

                                <dt class="text-size-small text-bold text-uppercase">
                                    <i class="icon-checkmark3 text-blue position-left"></i>
                                    Text Reviews
                                </dt>

                                <dd>Total Text Reviews :
                                    @if (isset($oUpgradePlanData->text_review_limit))
                                        {{ $oUpgradePlanData->text_review_limit }}
                                    @endif
                                </dd>

                                <dt class="text-size-small text-bold text-uppercase">
                                    <i class="icon-checkmark3 text-blue position-left"></i>
                                    Video Reviews
                                </dt>

                                <dd>Total Video Reviews :
                                    @if (isset($oUpgradePlanData->video_review_limit))
                                        {{ $oUpgradePlanData->video_review_limit }}
                                    @endif
                                </dd>

                                <dt class="text-size-small text-bold text-uppercase">
                                    <i class="icon-checkmark3 text-blue position-left"></i>
                                    Social Invites
                                </dt>

                                <dd>Get social invites on :

                                    @if (isset($oUpgradePlanData->social_invite_sources))
                                        {{ $oUpgradePlanData->social_invite_sources }}
                                    @endif

                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer pt-20" style="background: #f9f9f9; border-top: 1px solid #eee;">
                <div class="row">
                    <div class="col-md-9 text-left">
                        <h1 style="margin: 0;">For an additional <strong>${{ $additionalPriceToPay }}</strong> every {{ $billedCycle }},</h1>
                        <h4 style="margin: 0 0 10px;">You can get brandboost.io most popular plan</h4>
                        <p class="mb0">Want to get up to a 32% discount? <a data-toggle="modal" data-target="#upgrade_popup2" href="#">explore more plans</a>
                        </p>
                    </div>
                    <div class="col-md-3 pt-20 text-center">
                        <button type="button" class="btn btn-primary mb-10" id="btnLevelUpgrade" 
                                plan_name="
                                @if (isset($oUpgradePlanData->level_name))
                                    {{ $oUpgradePlanData->level_name }}
                                @endif
                                " plan_id="
                                    @if (isset($oUpgradePlanData->plan_id))
                                        {{ $oUpgradePlanData->plan_id }}
                                    @endif
                                " data-toggle="modal" data-target="#confirm_level_upgrade">
                            <i class="icon-cart"></i> &nbsp; Confirm Upgrade
                        </button>
                        <p>Your Card will be automatically charged</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="showannualPopup" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-top: 3px solid #0ea0dd">
            <div class="modal-header text-center">
                <button style="top: 20px;" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title mb-10"><strong>Upgrade your membership and get exciting features</strong></h4>

            </div>

            <div id="upgradeannualpopup" class="modal-body pricing_modal mb-20">
                <div class="row">
                    <!-- Pricing -->

                    @php
                    $i = 0;
                    foreach ($aAnnualUpgradeData as $key => $data) {
                        $totalPrice = $data->price;
                        if ($data->type == 'membership') {
                            $i++;
                            if ($data->subs_cycle == 'yearly') {

                                $moPrice = number_format($data->price / 12, 0);
                                $billedUnit = 'annually';
                                $perUnit = 'Year';
                            } else if ($data->subs_cycle == 'bi-yearly') {
                                $moPrice = number_format($data->price / 24, 0);
                                $billedUnit = 'bi-annually';
                                $perUnit = 'Bi-Year';
                            }
                            @endphp
                            <div class="col-md-{{ (sizeof($aAnnualUpgradeData) == 2) ? '6' : '12' }}">

                                <div class="selectedradio radion_container">
                                    <input type="radio" name="selectannualupgrade" plan_name="{{ $data->level_name }}" value="{{ $data->plan_id }}" id="box_annual_{{ $i }}"/>
                                    <span class="checkmark @if ($i == 1) redc  @elseif ($i == 2) yellowc @elseif ($i == 3) greenc @endif"></span>
                                </div>


                                <label for="box_annual_{{ $i }}">
                                    <div class="pricing hover-effect @if ($i == 1) red @elseif ($i == 2) yellow @elseif ($i == 3) green @endif">
                                        <div class="pricing-head">
                                            <h3>{{ $data->level_name }} </h3>
                                            <h4><i>USD</i>  ${{ $moPrice }} <i>/{{ $perUnit }}</i> <span> Billed {{ $billedUnit }} <br>(Total ${{ $data->price }})</span> </h4>
                                        </div>

                                        <p> {{ $data->description }}</p>
                                        <ul class="pricing-content list-unstyled">
                                            <li>Free Trials-{{ @($data->free_trial_days) }} Days</li>
                                            <li>Email Invites-{{ $data->email_limit }}</li>
                                            <li>Sms Invites-{{ $data->sms_limit }}</li>
                                            <li>Text Reviews-{{ $data->text_review_limit }}</li>
                                            <li>Video Reviews-{{ $data->video_review_limit }}</li>
                                            <li>Email Topup-@if (@($data->topup_email_limit)) Yes @else No @endif</li>
                                            <li>Sms Topup-@if (@($data->topup_sms_limit)) Yes @else No @endif</li>
                                            <li>Social Invites-@if ($data->social_invite_sources) Yes @else No @endif</li>
                                            <li>Google Invites-@if (strpos($data->social_invite_sources, 'Google') !== false) Yes @else No @endif</li>
                                            <li>Facebook Invites-@if (strpos($data->social_invite_sources, 'Facebook') !== false) Yes @else No @endif</li>
                                            <li>Yelp Invites-@if (strpos($data->social_invite_sources, 'Yelp') !== false) Yes @else No @endif</li>
                                            <li>Other Social Invites-@if (strpos($data->social_invite_sources, 'others') !== false) Yes @else No @endif></li>
                                        </ul>
                                        <div class="pricing-footer">
                                            <a href="javascript:;" class="btn yellow-crusta"> Sign Up </a> 
                                        </div>
                                    </div>
                                </label>

                            </div>
        @php
    }
}
@endphp

                    <!--//End Pricing -->
                </div>
            </div>


            <div class="modal-footer pt-20" style="background: #ffffff; border-top: 1px solid #eee;">
                <div class="row">
                    <div class="col-md-9 pt-10 text-left">
                        <img src="{{ URL::asset('assets/images/moneybackgurantee.jpg') }}"/>
                    </div>
                    <div class="col-md-3 pt-10 text-center">
                        <button type="button" class="btn btn-primary mb-10" data-toggle="modal" data-target="#confirm_level_upgrade" id="confirmAnnualUpgrade"><i class="icon-cart"></i> &nbsp; Confirm Upgrade</button>
                        <p class="mb0">Your Card will be automatically charged</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<!-- Upgrade plan Modal Confirm -->
<div id="confirm_level_upgrade" class="modal fade" style="z-index:99999;">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Confirm Upgrade</h5>
            </div>

            <div class="modal-body">
                <h6 class="text-semibold">Upgrade Your Account</h6>
                <div class="row">
                    <div class="col-md-12">

                        <table class="table table-hover table-striped table-bordered text-left mb-20" style="width:100%!important;">
                            <tr>
                                <td>Name :</td>
                                <td>
                                    @if (isset($aUInfo->firstname) || isset($aUInfo->lastname))
                                       {{ $aUInfo->firstname . ' ' . $aUInfo->lastname }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Email :</td>
                                <td>
                                    @if (isset($aUInfo->email)) 
                                       {{ $aUInfo->email }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Phone :</td>
                                <td>
                                    @if (isset($aUInfo->mobile))
                                        {{ $aUInfo->mobile }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Current Plan :</td>
                                <td>
                                    @if (isset($oCurrentPlanData->level_name)) 
                                        {{ $oCurrentPlanData->level_name }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Upgrade to :</td>
                                <td>
                                    <span id="upgradedPlanTitle">
                                        @if (isset($oUpgradePlanData->level_name)) 
                                            {{ $oUpgradePlanData->level_name }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>    


                <div class="checkbox">
                    <label>
                        <div class="border-primary-600 text-primary-800"><input class="control-primary" id="lvltermsCondition" type="checkbox">
                        </div>
                        I accept terms & condition
                    </label>
                </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" name="hidLevelPlanId" id="hidLevelPlanId" value="@if (isset($oUpgradePlanData->plan_id)) {{ $oUpgradePlanData->plan_id }} @endif"/>
                <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                <button type="button" id="confirmLevelUpdate" class="btn btn-primary">Yes, Upgrade Now</button>
            </div>
        </div>
    </div>
</div>

<div id="addMySubscriber" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="addMySubscriberData">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Subscriber</h5>
                </div>
                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;">
                        {{ Session::get('error_message') }}
                    </div>

                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="control-label">First Name</label>
                            <div class="">
                                <input name="firstname" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Last Name</label>
                            <div class="">
                                <input name="lastname" class="form-control" value="" type="text" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <div class="">
                                <input name="email" value="" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            <div class="">
                                <input name="phone" value="" class="form-control" type="text">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="tutorialspopup1" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <button style="top: 12px; right: 14px; position: absolute; z-index: 999;" type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body" style="padding-bottom: 80px;">
                <div class="row">
                    <div class="col-md-12">
                        <div id="DemoCarousel" class="carousel slide" data-interval="10000" data-ride="carousel">

                            <ol class="carousel-indicators">
                                <li data-target="#DemoCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#DemoCarousel" data-slide-to="1"></li>
                                <li data-target="#DemoCarousel" data-slide-to="2"></li>
                                <li data-target="#DemoCarousel" data-slide-to="3"></li>
                                <li data-target="#DemoCarousel" data-slide-to="4"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item tutorials active">
                                    <div class="row">
                                        <div class="col-xs-3"><img src="{{ URL::asset('assets/images/tutorials_icon.png') }}"/>
                                        </div>
                                        <div class="col-xs-9 pl0">
                                            <p><strong>Tutorial 1 : Manage you reviews</strong>
                                            </p>
                                            <p>All plans start out as a FREE Account which comes with 100 MB of testing quota. No credit card is required to sign up.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item tutorials">
                                    <div class="row">
                                        <div class="col-xs-3"><img src="{{ URL::asset('assets/images/tutorials_icon.png') }}"/>
                                        </div>
                                        <div class="col-xs-9 pl0">
                                            <p><strong>Tutorial 2 : Manage you reviews</strong>
                                            </p>
                                            <p>All plans start out as a FREE Account which comes with 100 MB of testing quota. No credit card is required to sign up.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item tutorials">
                                    <div class="row">
                                        <div class="col-xs-3"><img src="{{ URL::asset('assets/images/tutorials_icon.png') }}"/>
                                        </div>
                                        <div class="col-xs-9 pl0">
                                            <p><strong>Tutorial 3 : Manage you reviews</strong>
                                            </p>
                                            <p>All plans start out as a FREE Account which comes with 100 MB of testing quota. No credit card is required to sign up.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item tutorials">
                                    <div class="row">
                                        <div class="col-xs-3"><img src="{{ URL::asset('assets/images/tutorials_icon.png') }}"/>
                                        </div>
                                        <div class="col-xs-9 pl0">
                                            <p><strong>Tutorial 4 : Manage you reviews</strong>
                                            </p>
                                            <p>All plans start out as a FREE Account which comes with 100 MB of testing quota. No credit card is required to sign up.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item tutorials">
                                    <div class="row">
                                        <div class="col-xs-3"><img src="{{ URL::asset('assets/images/tutorials_icon.png') }}"/>
                                        </div>
                                        <div class="col-xs-9 pl0">
                                            <p><strong>Tutorial 5 : Manage you reviews</strong>
                                            </p>
                                            <p>All plans start out as a FREE Account which comes with 100 MB of testing quota. No credit card is required to sign up.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a class="btn dark_btn caro_next_btn" href="#DemoCarousel" data-slide="next">Next</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Add/Edit Contacts, Import, Export Popup -->

<div id="Addnewcontact" class="modal fade" style="z-index:999999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="addCentralSubscriberData">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="{{ URL::asset('assets/images/menu_icons/People_Color.svg') }}"/> Add new contact &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="firstname" id="firstname" class="form-control h52" type="text" onkeypress="return IsAlphabet(event);" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="lastname" id="lastname" class="form-control h52" value="" type="text" onkeypress="return IsAlphabet(event);" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="email" id="email" value="" class="form-control h52" type="email" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="phone" id="phone" value="" class="form-control h52" type="text" onkeypress="return IsNumeric(event);">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <div class="">
                                    <select class="form-control h52" name="gender" id="gender">
                                        <!-- <option>Select Gender</option> -->
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <div class="">
                                    <select class="form-control h52" name="country_code" id="country_code">
                                        <option value="">Select Country</option>
                                            @foreach ($countriesList as $countryName)
                                                <option value="{{ $countryName->country_code }}">{{ $countryName->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <div class="">
                                    <input name="cityName" id="cityName" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">State</label>
                                <div class="">
                                    <input name="stateName" id="stateName" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Zip Code</label>
                                <div class="">
                                    <input name="zipCode" id="zipCode" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Twitter Profile</label>
                                <div class="">
                                    <input name="twitter_profile" id="twitterProfile" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Facebook Profile</label>
                                <div class="">
                                    <input name="facebook_profile" id="facebookProfile" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">LinkedIn Profile</label>
                                <div class="">
                                    <input name="linkedin_profile" id="linkedinProfile" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Instagram Profile</label>
                                <div class="">
                                    <input name="instagram_profile" id="instagramProfile" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Other Social Profile</label>
                                <div class="">
                                    <input name="socialProfile" id="socialProfile" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="module_name" id="active_module_name" value="">
                    <input type="hidden" name="module_account_id" id="module_account_id" value="">

                    <button data-toggle="modal" id="addButton" type="submit" class="btn dark_btn bkg_sblue fsize14 h52"> Add contact</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="editCentralContact_sms" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateCentralSubscriberData_sms">
                <input type="hidden" id="avatarFinder" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><img src="{{ URL::asset('assets/images/menu_icons/People_Color.svg') }}"/> Update Contact &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="edit_firstname" id="edit_firstname_sms" class="form-control h52" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="edit_lastname" id="edit_lastname_sms" class="form-control h52" value="" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="edit_email" id="edit_email_sms" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="edit_phone" readonly="readonly" id="edit_phone_sms" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <div class="">
                                    <select class="form-control h52" name="edit_gender" id="edit_gender_sms">
                                        <option>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <div class="">
                                    <select class="form-control h52" name="edit_countryCode" id="edit_countryCode_sms">
                                        <option value="">Select Country</option>
                                            @foreach ($countriesList as $countryName)
                                                <option value="{{ $countryName->country_code }}"> {{ $countryName->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <div class="">
                                    <input name="edit_cityName" id="edit_cityName_sms" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">State</label>
                                <div class="">
                                    <input name="edit_stateName" id="edit_stateName_sms" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Zip Code</label>
                                <div class="">
                                    <input name="edit_zipCode" id="edit_zipCode_sms" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Twitter Profile</label>
                                <div class="">
                                    <input name="edit_twitter_profile" id="edit_twitterProfile_sms" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Facebook Profile</label>
                                <div class="">
                                    <input name="edit_facebook_profile" id="edit_facebookProfile_sms" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">LinkedIn Profile</label>
                                <div class="">
                                    <input name="edit_linkedin_profile" id="edit_linkedinProfile_sms" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Instagram Profile</label>
                                <div class="">
                                    <input name="edit_instagram_profile" id="edit_instagramProfile_sms" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Other Social Profile</label>
                                <div class="">
                                    <input name="edit_socialProfile" id="edit_socialProfile_sms" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer p40">
                    <input type="hidden" name="edit_module_name" id="edit_module_name_sms" value="">
                    <input type="hidden" name="edit_module_subscriber_id" id="edit_module_subscriber_id_sms" value="">

                    <button type="submit" id="addButton" class="btn dark_btn h52">Update</button>
                    <button class="btn btn-link h52" data-dismiss="modal">Cancel </button>

                </div>
            </form>
        </div>
    </div>
</div>



<div id="editCentralContact_main_web" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateCentralSubscriberData_main_web">
                <input type="hidden" id="avatarFinder_main_web" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><img src="{{ URL::asset('assets/images/menu_icons/People_Color.svg') }}"/> Update Contact &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="edit_firstname" id="edit_firstname_main_web" class="form-control h52" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="edit_lastname" id="edit_lastname_main_web" class="form-control h52" value="" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="edit_email" id="edit_email_main_web" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="edit_phone" readonly="readonly" id="edit_phone_main_web" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <div class="">
                                    <select class="form-control h52" name="edit_gender" id="edit_gender_main_web">
                                        <option>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <div class="">
                                    <select class="form-control h52" name="edit_countryCode" id="edit_countryCode_main_web">
                                        <option value="">Select Country</option>
                                            @foreach ($countriesList as $countryName)
                                                <option value="{{ $countryName->country_code }}"> {{ $countryName->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <div class="">
                                    <input name="edit_cityName" id="edit_cityName_main_web" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">State</label>
                                <div class="">
                                    <input name="edit_stateName" id="edit_stateName_main_web" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Zip Code</label>
                                <div class="">
                                    <input name="edit_zipCode" id="edit_zipCode_main_web" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Twitter Profile</label>
                                <div class="">
                                    <input name="edit_twitter_profile" id="edit_twitterProfile_main_web" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Facebook Profile</label>
                                <div class="">
                                    <input name="edit_facebook_profile" id="edit_facebookProfile_main_web" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">LinkedIn Profile</label>
                                <div class="">
                                    <input name="edit_linkedin_profile" id="edit_linkedinProfile_main_web" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Instagram Profile</label>
                                <div class="">
                                    <input name="edit_instagram_profile" id="edit_instagramProfile_main_web" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Other Social Profile</label>
                                <div class="">
                                    <input name="edit_socialProfile" id="edit_socialProfile_main_web" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer p40">
                    <input type="hidden" name="edit_module_name" id="edit_module_name_sms" value="">
                    <input type="hidden" name="edit_module_subscriber_id" id="edit_module_subscriber_id_main_web" value="">

                    <button type="submit" id="addButton" class="btn dark_btn h52">Update</button>
                    <button class="btn btn-link h52" data-dismiss="modal">Cancel </button>

                </div>
            </form>
        </div>
    </div>
</div>



<div id="editCentralContact" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateCentralSubscriberData">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><img src="{{ URL::asset('assets/images/menu_icons/People_Color.svg') }}"/> Update Contact &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="edit_firstname" id="edit_firstname" class="form-control h52" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="edit_lastname" id="edit_lastname" class="form-control h52" value="" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="edit_email" id="edit_email" value="" class="form-control h52" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="edit_phone" id="edit_phone" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <div class="">
                                    <select class="form-control h52" name="edit_gender" id="edit_gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" selected="selected">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <div class="">
                                    <select class="form-control h52" name="edit_countryCode" id="edit_countryCode">
                                        <option value="">Select Country</option>
                                            @foreach ($countriesList as $countryName)
                                                <option value="{{ $countryName->country_code }}"> {{ $countryName->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <div class="">
                                    <input name="edit_cityName" id="edit_cityName" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">State</label>
                                <div class="">
                                    <input name="edit_stateName" id="edit_stateName" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Zip Code</label>
                                <div class="">
                                    <input name="edit_zipCode" id="edit_zipCode" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Twitter Profile</label>
                                <div class="">
                                    <input name="edit_twitter_profile" id="edit_twitterProfile" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Facebook Profile</label>
                                <div class="">
                                    <input name="edit_facebook_profile" id="edit_facebookProfile" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">LinkedIn Profile</label>
                                <div class="">
                                    <input name="edit_linkedin_profile" id="edit_linkedinProfile" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Instagram Profile</label>
                                <div class="">
                                    <input name="edit_instagram_profile" id="edit_instagramProfile" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Other Social Profile</label>
                                <div class="">
                                    <input name="edit_socialProfile" id="edit_socialProfile" value="" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer p40">
                    <input type="hidden" name="edit_module_name" id="edit_module_name" value="">
                    <input type="hidden" name="edit_module_subscriber_id" id="edit_module_subscriber_id" value="">

                    <button type="submit" id="addButton" class="btn dark_btn h52">Update</button>
                    <button class="btn btn-link h52" data-dismiss="modal">Cancel </button>

                </div>
            </form>
        </div>
    </div>
</div>

<div id="importCentralCSV" class="modal modalpopup fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ base_url() }}admin/subscriber/importSubscriberCSV" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Import Contacts CSV</h5>
                </div>
                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;">{{ Session::get('error_message') }}</div>

                    <!-- <div class="form-group">
                       <label class="control-label col-lg-3">Import CSV</label>
                       <div class="col-lg-9">
                           <input type="file" name="userfile" style="margin-top:3px;" accept=".csv, application/vnd.ms-excel" required>
                       </div>
                   </div>  -->


                    <div class="form-group">
                        <label class="control-label">Import CSV</label>
                        <div class="">
                            <input type="file" name="userfile"  accept=".csv, application/vnd.ms-excel" class="form-control h52" style="padding-left: 182px; padding-top: 14px;" data-icon="false" required>
                        </div>
                    </div>

                    <!-- <label class="w100" for="myinputfile" >Import CSV
                       <div class="myfilebrowse">
                         <input class="hidden" type="file" id="myinputfile"/>
                       </div>
                   </label>  -->

                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="module_name" id="import_active_module_name" value="">
                    <input type="hidden" name="module_account_id" id="import_module_account_id" value="">
                    <input type="hidden" name="redirect_url" id="import_redirect_url" value="">
                    <!-- <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Import</button> -->
                    <button type="submit" class="btn dark_btn bkg_sblue fsize14 h52"> Import</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add/Edit Contacts, Import, Export Popup -->

<!--=====================================Delete Popup================================-->    
<div id="Deletepopup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="{{ URL::asset('assets/images/delete_icon.jpg') }}">Delete</h5>
                </div>
                <div class="modal-body p40 text-center">
                    <p class="txt_dark">Are you sure you want to delete it?</p>
                    <p class="txt_grey mb30" id="changeDeleteText">This profile will delete immediately.<br>
                        You can't undo this action.</p>
                    <div class="mb20 deletebuttonShow">
                        <button id="deleteConfirm" type="button" class="btn dark_btn bkg_sblue fsize14 h52"> Delete</button>
                        <button data-toggle="modal" id="deleteCancle" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                    </div>

                </div>
                <!--<div class="modal-footer text-center">
                    <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_sblue fsize14 h52"> Delete</button>
                    <button data-toggle="modal" id="nextpopup" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                    
                </div>-->
            </form>
        </div>
    </div>
</div>
<!--=====================================Delete Popup================================-->


<!--=====================================Archive================================-->  

<div id="archiveModalPopup" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                <div class="modal-header bkg_white">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title txt_dark"><img src="{{ URL::asset('assets/images/delete_icon.png') }}"> Are you want to move it to archive? <span class="grey" id="changeArchiveText">This profile will delete immediately.<br>You can't undo this action.</span></h5>
                </div>

                <div class="modal-footer p40">
                    <div class="row archivebuttonShow">
                        <div class="col-xs-6"><button data-dismiss="modal" id="archiveCancle" type="button" class="btn dark_btn h52 w100 ml0">Cancel</button></div>
                        <div class="col-xs-6"><button data-toggle="modal" id="archiveConfirm" type="button" class="btn white_btn h52 w100 ml0">Archive</button></div>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
<!--=====================================Archive================================-->





<!--=====================================Form notice================================-->
<div id="success_notice" class="hide">
    <div class="flag_notifications">
        <a style="cursor: pointer;" class="fn_close" name="cancel"><i class="icon-cross2 txt_green"></i></a>
        <div class="row">
            <div class="col-xs-2"><img width="40" src="{{ URL::asset('assets/images/notification_green.png') }}"/></div>
            <div class="col-xs-10">
                <p class="notification_success_msg_heading" style="font-weight:600;">Success!</p>
                <p class="mb-15 notification_success_msg_des">Your data have been updated successfully!</p>
            </div>
        </div>
    </div>
</div>

<div id="error_notice" class="hide">
    <div class="flag_notifications">
        <a style="cursor: pointer;" class="fn_close" name="cancel"><i class="icon-cross2 txt_red"></i></a>
        <div class="row">
            <div class="col-xs-2"><img width="40" src="{{ URL::asset('assets/images/notification_red.png') }}"/></div>
            <div class="col-xs-10">
                <p class="notification_success_msg_heading" style="font-weight:600;">OOPS!</p>
                <p class="mb-15 notification_success_msg_des">Your changes has been not updated. Please try again!</p>
            </div>
        </div>
    </div>
</div>

<!--=====================================Form notice================================-->

<!--=====================================Log out================================-->
<div id="logoutpopup" class="modal fade">
    <div style="width: 337px;" class="modal-dialog">
        <div class="">
            <!--<button type="button" class="close" data-dismiss="modal">×</button>-->
            <div class="logout_notifications p25" id="logout1">
                <a style="cursor: pointer" class="close_no close" data-dismiss="modal"><img src="{{ URL::asset('assets/images/cross_icon_10.png') }}"/></a> 
                <div class="media-left pr-15"><img src="{{ URL::asset('assets/images/logout_icon1.png') }}"/></div>
                <div class="media-left pr0">
                    <p class="txt_dark fw400">No Activity For {{ $inactivity_length }} Minutes</p>
                    <p class="txt_grey fw300">Do you want to remain logged<br> in Brand Boost?</p>
                    <button class="gery_btn logoutYes">Yes</button>
                    <button class="gery_btn txt_grey logoutNo">No</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="logoutpopupReminder" class="modal fade">
    <div style="width: 337px;" class="modal-dialog">
        <div class="">
            <!--<button type="button" class="close" data-dismiss="modal">×</button>-->
            <div class="logout_notifications p25" id="logout2">
                <a style="cursor: pointer" id="close2" class="close_no close" data-dismiss="modal"><img src="{{ URL::asset('assets/images/cross_icon_10.png') }}"/></a> 
                <div class="media-left pr-15"><img src="{{ URL::asset('assets/images/logout_icon2.png') }}"/></div>
                <div class="media-left pr0">
                    <p class="txt_dark fw400">Are you still there?</p>
                    <p class="txt_grey fw300">You’ve been gone for a while,<br> so we logged you out.</p>
                    <button class="gery_btn remainLoggedIn">Remain logged in</button>

                </div>
            </div>
        </div>
    </div>
</div>
<!--=====================================Log out================================-->

<!--=====================================Add Chat Shortcut Modal Popup================================-->    
<div id="addChatShortcutList" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="frmShortListModal">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close BoxClose" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="{{ URL::asset('assets/images/menu_icons/Chat_Color.svg') }}"> Add new shortcut &nbsp; <!--<i class="icon-info22 fsize12 txt_grey"></i>--></h5>
                    <p class="fsize12 txt_grey mt10 mb10" style="max-width: 370px;">Create a new shortcut. Give it a ! symbol, and write a message for this shortcut. Then, use conversations to quickly answer 
                        to visitors using the shortcut ! symbol. </p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="dvalue" id="dvalue">
                                <input type="hidden" name="dvalue" id="dvalue_shortcut">
                                <label class="control-label">Shortcut</label>
                                <div class="">
                                    <input placeholder="!shortname" name="shortname" id="shortname" class="form-control h52" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb0">
                                <label class="control-label">Conversation</label>
                                <div class="">
                                    <textarea class="form-control p20" name="conversatation" style="resize: none; min-height: 130px;" id="conversatation"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn dark_btn bkg_sblue fsize14 h52"><i class="icon-plus3"></i> &nbsp;  Add Shortcut</button>
                    <button data-dismiss="modal" class="close btn btn-link fsize14 txt_blue h52">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--=====================================Add Chat Shortcut Modal Popup End================================-->
