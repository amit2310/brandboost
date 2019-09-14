@php
	if (!empty($oMemberships)) {
		foreach ($oMemberships as $oMembership) {
			if ($oMembership->plan_id == $oUser->plan_id) {
				$oRegularMembership = $oMembership;
			}

			if ($oMembership->plan_id == $oUser->topup_plan_id) {
				$oTopupMembership = $oMembership;
			}
		}
	}

	$oCountries = getAllCountries();
@endphp
<style>
    .subscription_list tbody tr td{font-size:12px!important;}
</style>

<div class="tab-pane @if ($seletedTab == 'billing') active @endif" id="right-icon-tab3">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">General Preferences</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
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
                                        <input name="company_name" class="form-control updatecompanyprofileinfo" required="" value="{{ $oUser->company_name }}" placeholder="Wakers Inc." type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Company Profile</label>
                                    <div class="">
                                        <textarea class="form-control updatecompanyprofileinfo" name="company_description">{{ $oUser->company_description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <p class="pull-left mb0">Receiving newsletters:<br>
                                        <span class="text-muted fsize11">We'll send newsletters emails to {{ $oUser->email }}</span></p>
                                    <label class="custom-form-switch pull-right">
                                        <input class="field updatecompanyprofileinfo" name="receive_newsletter" type="checkbox" @if ($oUser->receive_newsletter) checked @endif>
                                        <span class="toggle"></span> </label>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group">
                                    <p class="pull-left mb0">Get a text when payments fail?<br>
                                        <span class="text-muted fsize11">We won’t text you about billing issues</span></p>
                                    <label class="custom-form-switch pull-right">
                                        <input class="field updatecompanyprofileinfo" name="receive_debug_notification" type="checkbox" @if ($oUser->receive_debug_notification) checked @endif >
                                        <span class="toggle"></span> </label>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--====Billing Info====-->
                    <div class="bbot p30">
                        <form id="frmGeneralBusinessInfo" name="frmGeneralBusinessInfo" method="post">
                            <div class="row">
                                <div class="col-md-3"><p class="text-muted">Billing Info</p></div>
                                <div class="col-md-9">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">First Name</label>
                                                <div class="">
                                                    <input name="billing_firstname" id="billing_firstname" class="form-control" required="" placeholder="Alen" type="text" value="{{ $oUser->billing_firstname }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Last Name</label>
                                                <div class="">
                                                    <input name="billing_lastname" id="billing_lastname" class="form-control" required="" placeholder="Sultanic" type="text" value="{{ $oUser->billing_lastname }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Address #1</label>
                                        <div class="">
                                            <input name="billing_address1" id="billing_address1" class="form-control" required="" placeholder="Address Line 1" type="text" value="{{ $oUser->billing_address1 }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Address #2</label>
                                        <div class="">
                                            <input name="billing_address2" id="billing_address2" class="form-control" required="" placeholder="Address Line 2" type="text" value="{{ $oUser->billing_address2 }}">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <div class="">
                                            <input name="billing_city" id="billing_city" class="form-control" required="" placeholder="City" type="text" value="{{ $oUser->billing_city }}">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Country</label>
                                                <div class="">
                                                    <select class="form-control" name="billing_country" id="billing_country">
                                                        <option value="">Select Country</option>
															@if (!empty($oCountries))
																@foreach ($oCountries as $oCountry)
																	<option value="{{ $oCountry->country_code }}" {!! ($oCountry->country_code == $oUser->billing_country) ? 'selected' : '' !!}>
																		{{ $oCountry->name }}
																	</option>
																@endforeach
															@endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">State</label>
                                                <div class="">
                                                    <select class="form-control" name="billing_state" id="billing_state">
                                                        <option {!! ($oUser->billing_state == 'Alabama') ? 'selected' : '' !!}>Alabama</option>
                                                        <option {!! ($oUser->billing_state == 'Delhi') ? 'selected' : '' !!}>Delhi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Zip Code</label>
                                                <div class="">
                                                    <input  name="billing_zipcode" id="billing_zipcode" class="form-control" required="" placeholder="Zip Code" type="text" value="{{ $oUser->billing_zipcode }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <div class="">
                                            <input name="billing_phone" id="billing_phone" class="form-control" required="" placeholder="Phone" type="text" value="{{ $oUser->billing_phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn dark_btn ml20 bkg_purple saveUserOtherInfo" >Save</span> </button>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!--====Active Card====-->
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3"><p class="text-muted">Active Card</p></div>
                            <div class="col-md-9">
                                <div class="card_sec p30">
                                    <div class="row mb20">
                                        <div class="col-xs-6"><img width="135" src="{{ base_url() }}assets/images/credit-cards.png"/></div>
                                        <div class="col-xs-6"><button class="btn btn-xs btn_white_table pull-right" data-toggle="modal" data-target="#cbChangeCC">@if (!empty($oUser->chargebee_cc_id)) Edit @else Add @endif Card</button></div>
                                    </div>

                                    <div class="row mb20 ccinfodetails" @if (empty($oUser->chargebee_cc_id)) style="display:none;" @endif>
                                        <div class="col-xs-12">
                                            <input type="text" id="savedccnum" class="form-control" disabled="disabled" value="XXXX-XXXX-XXXX {{ $oUser->cc_last_four }}" placeholder="XXXX-XXXX-XXXX 9613"/>
                                        </div>
                                    </div>
                                    <div class="row ccinfodetails" @if (empty($oUser->chargebee_cc_id)) style="display:none;" @endif >
                                        <div class="col-xs-3">
                                            <input type="text" id="savedExpiry" class="form-control" disabled="disabled" placeholder="e.g. 10 / 2021" value="{{ $oUser->cc_exp_month . ' / ' . $oUser->cc_exp_year }}"/>
                                        </div>
                                        <div class="col-xs-3">
                                            <p class="pull-left mb0"><span class="text-muted fsize11">EXP.<br>DATE</span></p>
                                        </div>
                                    </div>

                                    @if (empty($oUser->chargebee_cc_id))
                                        <div class="row ccinfoerror">
                                            <div class="col-xs-6 tex-center">
                                                <p class="pull-left mb0">Currently you haven't stored any credit card details yet.</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--====Subscription====-->
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3"><p class="text-muted">Subscriptions</p></div>
                            <div class="col-md-9">
                                @if (!empty($oUser->subscription_id))
                                    <div class="card_sec p0">
                                        <ul class="subscription_list">
                                            <li><span>Plan Name</span><strong class="pull-right">{{ $oRegularMembership->level_name }} ({{ ucfirst($oRegularMembership->subs_cycle) }}, USD)</strong></li>
                                            <li><span>Price</span><strong class="pull-right">${{ $oRegularMembership->price }}/{{ ucfirst($oRegularMembership->subs_cycle) }}</strong></li>
                                            <li><span>Subscription Status</span><strong class="pull-right">{{ ucfirst($oUser->regular_subscription_info->subscription_status) }}</strong></li>
                                            <li><span>Start</span><strong class="pull-right">{{ date("F dS Y", $oUser->regular_subscription_info->started_at) }}</strong></li>
                                            <li><span>Next Billing Date</span><strong class="pull-right">{{ date("F dS Y", $oUser->regular_subscription_info->next_billing_at) }}</strong></li>
                                            <li><span>End</span><strong class="pull-right">Recurring</strong></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                @endif

                                @if (!empty($oUser->topup_subscription_id))
                                    <br>
                                    <div class="card_sec p0">
                                        <ul class="subscription_list">
                                            <li><span>Plan Name</span><strong class="pull-right">{{ $oTopupMembership->level_name }} ({{ ucfirst($oTopupMembership->subs_cycle) }}, USD)</strong></li>
                                            <li><span>Price</span><strong class="pull-right">${{ $oTopupMembership->price }}/{{ ucfirst($oTopupMembership->subs_cycle) }}</strong></li>
                                            <li><span>Subscription Status</span><strong class="pull-right">{{ ucfirst($oUser->topup_subscription_info->subscription_status) }}</strong></li>
                                            <li><span>Start</span><strong class="pull-right">{{ date("F dS Y", $oUser->topup_subscription_info->started_at) }}</strong></li>
                                            <li><span>Next Billing Date</span><strong class="pull-right">{{ date("F dS Y", $oUser->topup_subscription_info->next_billing_at) }}</strong></li>
                                            <li><span>End</span><strong class="pull-right">Recurring</strong></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                @endif

                                @if (empty($oUser->subscription_id) && empty($oUser->topup_subscription_id))
                                    <i>No Subscription found</i>
                                @endif
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
                                            @php
											if (!empty($oInvoices)):
                                                foreach ($oInvoices as $oInvoice):
                                                    $invoiceData = App\Models\Admin\InvoicesModel::getInvoiceDetails($oInvoice->id);
                                                    @endphp
                                                    <tr>
                                                        <td><span class="text-muted">{{ date("F dS Y", $oInvoice->paid_at) }}</span></td>
                                                        <td><span class="pl0 txt_dark inv_details" invoice_id="{{ $oInvoice->id }}" style="cursor:pointer;"><strong class="text-left">
															@if (!empty($invoiceData[0]))
																{{ $invoiceData[0]->description }}
															@endif
															</strong></span></td>
                                                        <td><span class="txt_dark"><strong class="text-left">${{ number_format($oInvoice->amount_paid, 2) }}</strong></span></td>
                                                        <td><span class="text-right"><a href="{{ base_url() }}admin/invoices/download_invoice/{{ $oInvoice->id }}"><strong class="txt_purple">Download</strong></a></span></td>
                                                    </tr>
                                                @endforeach
											@endif
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
                    <div class="img_icon mb20"><img src="{{ base_url() }}assets/images/icon_card.png" width="35"></div>
                    <p class="mb20"><strong>Manage your billing</strong></p>
                    <p class="mb20"><span>Being the savage's bowsman, that <br>is, the person who pulled.</span></p>
                    <a class="txt_purple" href="#">Learn More</a>
                </div>
            </div>
        </div>




    </div>
</div>

<div id="cbChangeCC" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="frmSaveCCDetails" method="post" class="form-horizontal">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="{{ base_url() }}assets/images/edit_email_icon.png"> Add/Change Credit Card Details <span>Store your card card details on file directly at merchant site, highly secure and reliable</span></h5>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="card_sec p0">
                            <div class="row bbot form_box">
                                <div class="col-xs-4"><label>Credit Card Number</label></div>
                                <div class="col-xs-8">
                                    <input placeholder="Enter Credit Card Number" name="ccNum"  class="form-control" type="text" maxlength="16" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="row bbot form_box">
                                <div class="col-xs-4"><label>Security Code</label></div>
                                <div class="col-xs-8">
                                    <input placeholder="Enter Security Code" name="cvv" maxlength="4" class="form-control" type="text" required>
                                </div>
                            </div>

                            <div class="row bbot form_box">
                                <div class="col-xs-4"><label>Exp Month</label></div>
                                <div class="col-xs-8">
                                    <select name="expMonth" class="form-control">
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
                                    <select name="expYear" class="form-control">
                                        <option value="">YYYY</option>
                                        @for ($i = date('Y'); $i <= date('Y', strtotime('+20 years')); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
										@endfor
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p40">
                    <button data-dismiss="modal" type="button" class="btn white_btn h52">Cancel</button>
                    <button type="submit" class="btn dark_btn bkg_sblue h52"><i class="fa fa-cart-plus"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="invoice_details" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content invc"></div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $(document).on("click", ".inv_details", function () {
            $('.overlaynew').show();
            var invoiceid = $(this).attr('invoice_id');
            $.ajax({
                url: "{{ base_url('admin/invoices/get') }}",
                type: "POST",
                data: {_token: '{{csrf_token()}}', invoice_id: invoiceid},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $(".invc").html(data.content);
                        $("#invoice_details").modal("show");
                        $('.overlaynew').hide();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $('input[name="ccNum"], input[name="cvv"]').keypress(function (evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        });

        $("#frmSaveCCDetails").submit(function () {
            var formData = $(this).serialize();
            $('.overlaynew').show();
            $.ajax({
                url: "{{ base_url('payment/storeCreditCard') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#savedccnum").val('XXXX-XXXX-XXXX-' + data.info.cc_last_four);
                        $("#savedExpiry").val(data.info.cc_exp_month + '/' + data.info.cc_exp_year);
                        $(".ccinfoerror").hide();
                        $(".ccinfodetails").show();
                        $("#cbChangeCC").modal('hide');
                        $('.overlaynew').hide();
                    } else {
                        //display error message if required
                        alertMessage("Not a valid or wrong credit card details");
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });


        $(".updatecompanyprofileinfo").blur(function () {
            var fieldname = $(this).attr('name');
            var fieldval = $(this).val();
            $.ajax({
                url: "{{ base_url('admin/settings/updateCompanyProfile') }}",
                type: "POST",
                data: {
                    fieldname: fieldname,
                    fieldval: fieldval,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //display success message if required
                    } else {
                        //display error message if required
                    }
                }
            });
        });

        $('input[name="receive_newsletter"], input[name="receive_debug_notification"]').change(function () {
            if ($(this).is(":checked") == true) {
                $(this).attr("value", 1);
            } else {
                $(this).attr("value", 0);
            }
        })

        setTimeout(function () {
            $('.subscription_list_head').hide();
        }, 1000);
    });
</script>
