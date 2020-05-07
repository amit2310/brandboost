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
                            <li  class="active"><a href="#/settings/billing" style="cursor:pointer; padding: 5px;">Billing&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/notification" style="cursor:pointer; padding: 5px;">Notifications&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/import" style="cursor:pointer; padding: 5px;">Import&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/export" style="cursor:pointer;">Export</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix">&nbsp;</div>

        <loading :isLoading="loading"></loading>
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
                                                            <option :value='`Alabama`'>Alabama</option>
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
                                        <button type="submit" class="btn dark_btn ml20 bkg_purple" @click="saveUserOtherInfo()">Save</button>

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
                                            <div class="col-xs-6"><button class="btn btn-xs btn_white_table pull-right" data-toggle="modal" data-target="#cbChangeCC">
                                                <span v-if="oUser.chargebee_cc_id !=''">Edit Card</span>
                                                <span v-else>Add Card</span>
                                            </button></div>

                                        </div>

<!--                                        <div class="row mb20 ccinfodetails" @if (empty(oUser.chargebee_cc_id)) style="display:none;" @endif>-->
                                        <div class="row mb20 ccinfodetails">
                                            <div class="col-xs-12">
<!--                                                {{oUser.cc_last_four }}-->
                                                <input type="text" id="savedccnum" class="form-control" disabled="disabled" v-bind:value="'XXXX-XXXX-XXXX-'+oUser.cc_last_four" placeholder="XXXX-XXXX-XXXX 9613"/>
                                            </div>
                                        </div>
<!--                                        <div class="row ccinfodetails" @if (empty(oUser.chargebee_cc_id)) style="display:none;" @endif >-->
                                        <div class="row ccinfodetails">
                                            <div class="col-xs-3">
<!--                                                {{oUser.cc_exp_month + ' / ' + oUser.cc_exp_year }}-->
                                                <input type="text" id="savedExpiry" class="form-control" disabled="disabled" placeholder="e.g. 10 / 2021" v-bind:value="oUser.cc_exp_month+' / '+oUser.cc_exp_year"/>
                                            </div>
                                            <div class="col-xs-3">
                                                <p class="pull-left mb0"><span class="text-muted fsize11">EXP.<br>DATE</span></p>
                                            </div>
                                        </div>

<!--                                        @if (empty(oUser.chargebee_cc_id))-->
                                        <div class="row ccinfoerror" v-if="oUser.chargebee_cc_id ==''">
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
                                  <!--   {{ oUser.regular_subscription_info.next_billing_at}}
                                    {{oCurrentPlanData}}
                                    {{oUser.regular_subscription_info}} -->
                                    <div class="card_sec p0" v-if="oUser.subscription_id">
                                        <ul class="subscription_list">
                                            <li><span>Plan Name</span><strong class="pull-right">{{ oCurrentPlanData.level_name }} ({{ oCurrentPlanData.subs_cycle | capitalize }}, USD)</strong></li>
                                            <li><span>Price</span><strong class="pull-right">${{ oCurrentPlanData.price }}/{{ oCurrentPlanData.subs_cycle | capitalize }}</strong></li>
                                            <li><span>Subscription Status</span><strong class="pull-right">{{ oUser.regular_subscription_info.subscription_status | capitalize }}</strong></li>
                                            <li><span>Start</span><strong class="pull-right">
                                        {{ timestampToDateFormat(oUser.regular_subscription_info.trial_start) }}
                                             </strong></li>
                                            <li><span>Next Billing Date</span><strong class="pull-right">{{ timestampToDateFormat(oUser.regular_subscription_info.next_billing_at) }}</strong></li>
                                            <li><span>End</span><strong class="pull-right">Recurring</strong></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
<!--                                    @endif-->


                                    <br>
                                     <div class="card_sec p0" v-if="oUser.topup_subscription_id">
                                        <ul class="subscription_list">
                                            <li><span>Plan Name</span><strong class="pull-right">{{ oCurrentTopupPlanData.level_name }} ({{ oCurrentTopupPlanData.subs_cycle | capitalize }}, USD)</strong></li>
                                            <li><span>Price</span><strong class="pull-right">${{ oCurrentTopupPlanData.price }}/{{ oCurrentTopupPlanData.subs_cycle | capitalize }}</strong></li>
                                           <li><span>Subscription Status</span>
                                                <strong class="pull-right">
                                               {{ oUser.topup_subscription_info.subscription_status }}</strong>
                                           </li>
                                            <li><span>Start</span>
                                                <strong class="pull-right">
                                                    {{ timestampToDateFormat(oUser.topup_subscription_info.started_at) }}
                                               </strong></li>
                                            <li><span>Next Billing Date</span>
                                                <strong class="pull-right">
                                                {{ timestampToDateFormat(oUser.topup_subscription_info.next_billing_at) }}
                                            </strong></li>
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

                        <div class="row p20">
                            <div class="col-md-12">
                                <div class="col-md-12 mb-20"><p class="text-muted">Past Invoices</p></div>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td colspan="1"><span class="fsize12 fw300">Date </span></td>
                                                <td><span class="fsize12 fw300">Subscriptions</span></td>
                                                <td><span class="fsize12 fw300">Price</span></td>
                                                <td><span class="fsize12 fw300">Action</span></td>
                                            </tr>
                                            <tr v-for="oInvoice in oInvoices.data" v-if="oInvoices.data">
                                                <td><span class="text-muted">{{ displayDateFormat("F dS Y", oInvoice.created) }}</span></td>
                                                <td>
<!--                                                    {{oInvoice.plan_id}}-->
                                                    <span class="text-muted" v-if="oInvoice.plan_id =='medium-businesses-yearly'">Medium Businesses Yearly</span>
                                                    <span class="text-muted" v-else-if="oInvoice.plan_id =='topup-membership-a'">Credit Membership</span>
                                                     <span class="text-muted" v-else>{{oInvoice.plan_id}}</span>
                                                </td>
                                                <td><span class="text-muted">${{ number_format(oInvoice.amount_paid, 2)}}</span></td>
<!--                                                <td><span class="text-muted">{{ oInvoice.invoice_status }}</span></td>-->
                                                <td><span class="text-muted"><a target="_blank" v-bind:href="'admin/invoices/download_invoice/'+oInvoice.id">download</a></span></td>
                                            </tr>
                                         </tbody>
                                    </table>
                                     <pagination
                                         :pagination="oInvoices"
                                          @paginate="showPaginationData"
                                          :offset="4">
                                      </pagination>
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
                                            <!--                        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>-->
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
        <div id="cbChangeCC" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
<!--                    <form id="frmSaveCCDetails" method="post" class="form-horizontal">-->

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h5 class="modal-title"><img src="assets/images/edit_email_icon.png"> Add/Change Credit Card Details <span>Store your card card details on file directly at merchant site, highly secure and reliable</span></h5>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <div class="card_sec p0">
                                    <div class="row bbot form_box">
                                        <div class="col-xs-4"><label>Credit Card Number</label></div>
                                        <div class="col-xs-8">
                                            <input placeholder="Enter Credit Card Number" v-model="ccCardDetail.ccNum" id="ccNum"  class="form-control" type="text" maxlength="16" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="row bbot form_box">
                                        <div class="col-xs-4"><label>Security Code</label></div>
                                        <div class="col-xs-8">
                                            <input placeholder="Enter Security Code" v-model="ccCardDetail.cvv" id="cvv" maxlength="4" class="form-control" type="text" required>
                                        </div>
                                    </div>

                                    <div class="row bbot form_box">
                                        <div class="col-xs-4"><label>Exp Month</label></div>
                                        <div class="col-xs-8">
                                            <select v-model="ccCardDetail.expMonth" id="expMonth" class="form-control">
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


                                    <div class="row bbot form_box">
                                        <div class="col-xs-4"><label>Exp Year</label></div>
                                        <div class="col-xs-8">
                                            <select v-model="ccCardDetail.expYear" id="expYear" class="form-control">
                                                <option value="">YYYY</option>
                                                <option v-for="year in years" :value="year">{{ year }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p40">
                            <button data-dismiss="modal" type="button" class="btn white_btn h52">Cancel</button>
                            <button type="submit" class="btn dark_btn bkg_sblue h52" @click="frmSaveCCDetails()"><i class="fa fa-cart-plus"></i> Save</button>
                        </div>
<!--                    </form>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Pagination from '@/components/helpers/Pagination';
    export default {
        name: "SettingBilling",
        title: 'Admin Settings - Brand Boost',
        components: {Pagination},
        data() {
            return {


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
                ccCardDetail: {},
                current_page: 1,
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
        computed : {
            years () {
                const year = new Date().getFullYear()
                return Array.from({length: 21}, (value, index) => year + index)
            }
        },
        methods: {
            showPaginationData: function(current_page){
                this.current_page =current_page;
                this.loadData();
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadData();
            },
            loadData: function () {
                //getData
                this.loading = true;
                console.log(this.current_page);
                axios.get('/admin/settings?page='+this.current_page,{
                        params: {
                            current_tab:'billing'
                        }
                    })
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
            frmSaveCCDetails:function(){
                this.loading = true;
                console.log(this.ccCardDetail.ccNum.length);
                var cslngth = (this.ccCardDetail.ccNum.length)?this.ccCardDetail.ccNum.length:0
                if(this.ccCardDetail.ccNum  =='' || cslngth !=16){
                    $('#ccNum').focus();
                    return false;
                }
                if(this.ccCardDetail.cvv  =='' || (this.ccCardDetail.cvv.length < 3 || this.ccCardDetail.cvv.length > 4)){
                    $('#cvv').focus();
                    return false;
                }
                 if(this.ccCardDetail.expMonth  ==''){
                    $('#expMonth').focus();
                    return false;
                }
                if(this.ccCardDetail.expYear  ==''){
                    $('#expYear').focus();
                    return false;
                }
                axios.post('/payment/storeCreditCard', {
                    ccNum: this.ccCardDetail.ccNum,
                    expMonth: this.ccCardDetail.expMonth,
                    expYear: this.ccCardDetail.expYear,
                    cvv: this.ccCardDetail.cvv,
                })
                    .then(response => {
                        this.loading = false;
                        this.loadData();
                        // this.ccCardDetail.ccNum
                        console.log(response.data);
                        $('#cbChangeCC').modal('hide');
                    });
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
             $('input[name="ccNum"], input[name="cvv"]').keypress(function (evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                 return true;
            });
        });

    }
</script>

<style scoped>

</style>
