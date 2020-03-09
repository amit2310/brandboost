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
                            <li><a href="#/settings/subscription" style="cursor:pointer; padding: 5px;">Subscription & Credits&nbsp;</a></li>&nbsp;&nbsp;
                            <li class="active"><a href="#/settings/billing" style="cursor:pointer; padding: 5px;">Billing&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/general" style="cursor:pointer; padding: 5px;">Notifications&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/general" style="cursor:pointer; padding: 5px;">Import&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/general" style="cursor:pointer;">Export</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix">&nbsp;</div>

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-flat review_ratings">
                    <div class="panel-heading">
                        <h6 class="panel-title">General Preferences</h6>
                    </div>
                    <div class="panel-body p0">
                        <!--====GENERAL SETTINGS====-->
                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-3"><p class="text-muted">Company Info</p></div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label">Company</label>
                                        <div class="">
                                            <input name="company_name" class="form-control updatecompanyprofileinfo" required="" v-model="oUser.company_name" placeholder="Wakers Inc." type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Company Profile</label>
                                        <div class="">
                                            <textarea class="form-control updatecompanyprofileinfo" name="company_description" v-model="oUser.company_description">{{ oUser.company_description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p class="pull-left mb0">Receiving newsletters:<br>
                                            <span class="text-muted fsize11">We'll send newsletters emails to {{ oUser.email }}</span></p>
                                        <label class="custom-form-switch pull-right">
                                            <input class="field updatecompanyprofileinfo" name="receive_newsletter" type="checkbox" v-model="oUser.receive_newsletter">
                                            <span class="toggle"></span> </label>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group">
                                        <p class="pull-left mb0">Get a text when payments fail?<br>
                                            <span class="text-muted fsize11">We won’t text you about billing issues</span></p>
                                        <label class="custom-form-switch pull-right">
                                            <input class="field updatecompanyprofileinfo" name="receive_debug_notification" type="checkbox" v-model="oUser.receive_debug_notification">
                                            <span class="toggle"></span> </label>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--====Billing Info====-->
                        <div class="bbot p30">
<!--                            <form id="frmGeneralBusinessInfo" name="frmGeneralBusinessInfo" method="post">-->
                                <div class="row">
                                    <div class="col-md-3"><p class="text-muted">Billing Info</p></div>
                                    <div class="col-md-9">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">First Name</label>
                                                    <div class="">
                                                        <input name="billing_firstname" id="billing_firstname" class="form-control" required="" placeholder="Alen" type="text" v-model="oUser.billing_firstname">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <div class="">
                                                        <input name="billing_lastname" id="billing_lastname" class="form-control" required="" placeholder="Sultanic" type="text" v-model="oUser.billing_lastname">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Address #1</label>
                                            <div class="">
                                                <input name="billing_address1" id="billing_address1" class="form-control" required="" placeholder="Address Line 1" type="text" v-model="oUser.billing_address1">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Address #2</label>
                                            <div class="">
                                                <input name="billing_address2" id="billing_address2" class="form-control" required="" placeholder="Address Line 2" type="text" v-model="oUser.billing_address2">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">City</label>
                                            <div class="">
                                                <input name="billing_city" id="billing_city" class="form-control" required="" placeholder="City" type="text" v-model="oUser.billing_city">
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Country</label>
                                                    <div class="">
                                                        <select class="form-control" name="billing_country" id="billing_country" v-model="oUser.billing_country">
                                                            <option value="">Select Country</option>
                                                            <option v-for="country in countries" :value="country.country_code"> {{country.name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">State</label>
                                                    <div class="">
                                                        <select class="form-control" name="billing_state" id="billing_state" v-model="oUser.billing_state">
                                                            <option :value='`Alabama`'>Alabama}</option>
                                                            <option :value='`Delhi`'>Delhi</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Zip Code</label>
                                                    <div class="">
                                                        <input  name="billing_zipcode" id="billing_zipcode" class="form-control" required="" placeholder="Zip Code" type="text" v-model="oUser.billing_zipcode">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Phone</label>
                                            <div class="">
                                                <input name="billing_phone" id="billing_phone" class="form-control" required="" placeholder="Phone" type="text" v-model="oUser.billing_phone">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn dark_btn ml20 bkg_purple" v-on:click="saveUserOtherInfo()">Save</button>

                                    </div>
                                </div>
<!--                            </form>-->
                        </div>
                        <!--====Active Card====-->
                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-3"><p class="text-muted">Active Card</p></div>
                                <div class="col-md-9">
                                    <div class="card_sec p30">
                                        <div class="row mb20">
                                            <div class="col-xs-6"><img width="135" src="assets/images/credit-cards.png"/></div>
                                            <div class="col-xs-6"><button class="btn btn-xs btn_white_table pull-right" data-toggle="modal" data-target="#cbChangeCC">@if (!empty(oUser.chargebee_cc_id)) Edit @else Add @endif Card</button></div>
                                        </div>

<!--                                        <div class="row mb20 ccinfodetails" @if (empty(oUser.chargebee_cc_id)) style="display:none;" @endif>-->
                                        <div class="row mb20 ccinfodetails">
                                            <div class="col-xs-12">
<!--                                                {{oUser.cc_last_four }}-->
                                                <input type="text" id="savedccnum" class="form-control" disabled="disabled" value="XXXX-XXXX-XXXX " placeholder="XXXX-XXXX-XXXX 9613"/>
                                            </div>
                                        </div>
<!--                                        <div class="row ccinfodetails" @if (empty(oUser.chargebee_cc_id)) style="display:none;" @endif >-->
                                        <div class="row ccinfodetails">
                                            <div class="col-xs-3">
<!--                                                {{oUser.cc_exp_month + ' / ' + oUser.cc_exp_year }}-->
                                                <input type="text" id="savedExpiry" class="form-control" disabled="disabled" placeholder="e.g. 10 / 2021" value=""/>
                                            </div>
                                            <div class="col-xs-3">
                                                <p class="pull-left mb0"><span class="text-muted fsize11">EXP.<br>DATE</span></p>
                                            </div>
                                        </div>

<!--                                        @if (empty(oUser.chargebee_cc_id))-->
                                        <div class="row ccinfoerror">
                                            <div class="col-xs-6 tex-center">
                                                <p class="pull-left mb0">Currently you haven't stored any credit card details yet.</p>
                                            </div>
                                        </div>
<!--                                        @endif-->
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        {{oUser}}-->
                        <!--====Subscription====-->
                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-3"><p class="text-muted">Subscriptions</p></div>
                                <div class="col-md-9">
<!--                                    {{ oUser.regular_subscription_info}}-->
<!--                                    {{oCurrentPlanData}}-->
                                    <div class="card_sec p0" v-if="oUser.subscription_id">
                                        <ul class="subscription_list">
                                            <li><span>Plan Name</span><strong class="pull-right">{{ oCurrentPlanData.level_name }} ({{ oCurrentPlanData.subs_cycle | capitalize }}, USD)</strong></li>
                                            <li><span>Price</span><strong class="pull-right">${{ oCurrentPlanData.price }}/{{ oCurrentPlanData.subs_cycle | capitalize }}</strong></li>
                                            <li><span>Subscription Status</span><strong class="pull-right">{{ oUser.regular_subscription_info.subscription_status | capitalize }}</strong></li>
                                            <li><span>Start</span><strong class="pull-right">{{ displayDateFormat("F dS Y", oCurrentPlanData.created) }}</strong></li>
                                            <li><span>Next Billing Date</span><strong class="pull-right">{{ displayDateFormat("F dS Y", oUser.regular_subscription_info.next_billing_at) }}</strong></li>
                                            <li><span>End</span><strong class="pull-right">Recurring</strong></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
<!--                                    @endif-->

<!--                                    {{oCurrentTopupPlanData}}-->
                                    <br>
                                     <div class="card_sec p0" v-if="oUser.topup_subscription_id">
                                        <ul class="subscription_list">
                                            <li><span>Plan Name</span><strong class="pull-right">{{ oCurrentTopupPlanData.level_name }} ({{ oCurrentTopupPlanData.subs_cycle | capitalize }}, USD)</strong></li>
                                            <li><span>Price</span><strong class="pull-right">${{ oCurrentTopupPlanData.price }}/{{ oCurrentTopupPlanData.subs_cycle | capitalize }}</strong></li>
<!--                                            <li><span>Subscription Status</span><strong class="pull-right">{{ ucfirst(oUser.topup_subscription_info.subscription_status) }}</strong></li>-->
<!--                                            <li><span>Start</span><strong class="pull-right">{{ displayDateFormat("F dS Y", oCurrentTopupPlanData.started_at) }}</strong></li>-->
<!--                                            <li><span>Next Billing Date</span><strong class="pull-right">{{ // displayDateFormat("F dS Y", oUser.topup_subscription_info.next_billing_at) }}</strong></li>-->
                                            <li><span>End</span><strong class="pull-right">Recurring</strong></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
<!--                                    @endif-->

<!--                                    @if (empty($oUser->subscription_id) && empty($oUser->topup_subscription_id))-->
<!--                                    <i>No Subscription found</i>-->
<!--                                    @endif-->
                                </div>
                            </div>
                        </div>
                        <!--====GENERAL SETTINGS====-->
                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-12 mb-20"><p class="text-muted">Past Invoices</p></div>
                                <div class="col-md-12">
                                    <div class="card_sec p0">
                                        <table class="subscription_list table datatable-basic datatable-sorting">
                                            <thead class="subscription_list_head">
                                            <tr>
                                                <td>Date</td>
                                                <td>Subscriptions</td>
                                                <td>Price</td>
                                                <td>Action</td>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr v-if="oInvoices" v-for="oInvoice in oInvoices">
<!--                                                {{// oInvoice}}-->
                                                <td><span class="text-muted">{{ displayDateFormat("F dS Y", oInvoice.created) }}</span></td>
                                                <td><span class="text-muted">{{ displayDateFormat("F dS Y", oInvoice.created) }}</span></td>
                                                <td><span class="text-muted">{{ number_format(oInvoice.amount_paid, 2)}}</span></td>
                                                <td><span class="text-muted">{{ oInvoice.invoice_status }}</span></td>
<!--    {{ invoiceData[43].description}}-->

                                            </tr>
<!--                                            @php-->
<!--                                            if (!empty($oInvoices)):-->
<!--                                            foreach ($oInvoices as $oInvoice):-->
<!--                                            $invoiceData = App\Models\Admin\InvoicesModel::getInvoiceDetails($oInvoice->id);-->
<!--                                            @endphp-->
<!--                                            <tr>-->
<!--                                                <td><span class="text-muted">{{ date("F dS Y", $oInvoice->paid_at) }}</span></td>-->
<!--                                                <td><span class="pl0 txt_dark inv_details" invoice_id="{{ $oInvoice->id }}" style="cursor:pointer;"><strong class="text-left">-->
<!--															@if (!empty($invoiceData[0]))-->
<!--																{{ $invoiceData[0]->description }}-->
<!--															@endif-->
<!--															</strong></span></td>-->
<!--                                                <td><span class="txt_dark"><strong class="text-left">${{ number_format($oInvoice->amount_paid, 2) }}</strong></span></td>-->
<!--                                                <td><span class="text-right"><a href="{{ base_url() }}admin/invoices/download_invoice/{{ $oInvoice->id }}"><strong class="txt_purple">Download</strong></a></span></td>-->
<!--                                            </tr>-->
<!--                                            @endforeach-->
<!--                                            @endif-->
                                            </tbody>
                                        </table>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <div class="img_icon mb20"><img src="assets/images/icon_card.png" width="35"></div>
                        <p class="mb20"><strong>Manage your billing</strong></p>
                        <p class="mb20"><span>Being the savage's bowsman, that <br>is, the person who pulled.</span></p>
                        <a class="txt_purple" href="#">Learn More</a>
                    </div>
                </div>
            </div>




        </div>

    </div>
</template>

<script>
    export default {
        name: "SettingBilling",
        title: 'Admin Settings - Brand Boost',
        data() {
            return {
                successMsg: '',
                errorMsg: '',
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
                invoiceData: '',
                notificationlisting: '',
                oUser: '',
                countries: {},
            }
        },
        mounted() {
            this.loadData();
            setTimeout(function(){
                loadJQCode();
            },2000);
        },
        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            }
        },
        methods: {
            loadData: function () {
                //getData
                this.loading = true;
                axios.get('/admin/settings')
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
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
                        this.invoiceData = response.data.invoiceData;
                        this.notificationlisting = response.data.notificationlisting;
                        this.oUser = response.data.oUser;
                        this.countries = response.data.countries;

                    });
            },
            dispUpgradePlan: function (painType){
                this.oCurrentPlanData.subs_cycle= painType
            },

            saveUserOtherInfo:function(){
                this.loading = true;

                    axios.post('/admin/settings/saveBillingInfo', {
                        company_name:this.oUser.company_name,
                        company_description:this.oUser.company_description,
                        receive_newsletter:this.oUser.receive_newsletter,
                        receive_debug_notification:this.oUser.receive_debug_notification,
                        billing_firstname:this.oUser.billing_firstname,
                        billing_lastname:this.oUser.billing_lastname,
                        billing_address1:this.oUser.billing_address1,
                        billing_address2:this.oUser.billing_address2,
                        billing_city:this.oUser.billing_city,
                        billing_zipcode:this.oUser.billing_zipcode,
                        billing_state:this.oUser.billing_state,
                        billing_country:this.oUser.billing_country,
                    })
                        .then(response => {
                            // $bvModal.hide('confirm_topup_level_upgrade')
                            this.loading = false;
                            this.loadData();
                        });

            },
            confirmLevelUpgrade: function (){
                this.loading = true;
                if(this.buyCredits.acceptTerms) {
                    axios.post('/payment/upgradeMembership', {
                        plan_id: this.buyCredits.planID,
                    })
                        .then(response => {
                            // $bvModal.hide('confirm_topup_level_upgrade')
                            this.buyCredits.acceptTerms =false;
                            this.loading = false;
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
                this.loading = true;
                if(this.buyCredits.acceptTerms) {
                    axios.post('/payment/upgradeTopupMembership', {
                        toup_plan_id: this.buyCredits.planID,
                    })
                        .then(response => {
                            // $bvModal.hide('confirm_topup_level_upgrade')
                            this.buyCredits.acceptTerms =false;
                            this.loading = false;
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
                this.loading = true;
                if(this.buyCredits.acceptTerms) {
                    axios.post('/payment/buyCreditAddons', {
                        toup_plan_id: this.buyCredits.planID,
                    })
                        .then(response => {
                            this.buyCredits.acceptTerms =false;
                            this.loading = false;
                            this.loadData();
                            $('#confirm_buy_addon_plan').modal('hide');
                        });
                }else{
                    this.buyCredits.selectTerms ="Please select accept terms & condition."
                }
            },
            confirmCustomAddOnBuy: function (){payment/buyCreditAddons
                this.loading = true;
                var planID ='custom-pack'
                var qty ='1000';
                if(this.buyCredits.acceptTerms) {
                    axios.post('/payment/buyCreditAddons', {
                        toup_plan_id: this.buyCredits.planID,
                        quantity: this.buyCredits.quantity
                    })
                        .then(response => {
                            this.buyCredits.acceptTerms =false;
                            this.loading = false;
                            this.loadData();
                            $('#confirm_buy_custom_addon_plan').modal('hide');
                        });
                }else{
                    this.buyCredits.selectTerms ="Please select accept terms & condition."
                }
            },
            saveGeneralPreferences: function () {
                this.loading = true;
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
                        this.loading = false;
                        this.loadData();
                    });
            },
            saveFieldsSettings: function () {
                this.loading = false;
                axios.post('/admin/settings/saveFieldsSettings',{
                    reviewer_alias:this.oUser.reviewer_alias,
                    seller_alias:this.oUser.seller_alias,
                    review_alias:this.oUser.review_alias,
                })
                    .then(response => {
                        this.loading = false;
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
