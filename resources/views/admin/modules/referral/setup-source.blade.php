@extends('layouts.main_template')

@section('title')
    {{ $title }}
@endsection

@section('contents')
    <div class="content">

        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-7">
                    <h3 class="mt30"><img style="width: 16px;" src="{{ base_url() }}assets/images/refferal_icon.png">
                        New Referral Campaign</h3>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-5 text-right btn_area">

                    <button type="button" style="padding: 7px 15px!important;"
                            class="btn dark_btn publishReferralStatus" status="draft"><i class="icon-plus3"></i><span> &nbsp;  Save as Draft</span>
                    </button>

                    <button type="button" style="padding: 7px 15px!important;"
                            class="btn dark_btn publishReferralStatus" status="active"><i class="icon-plus3"></i><span> &nbsp;  Publish</span>
                    </button>
                </div>
            </div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

        <!--==================Broadcasts Menu============-->
        <div class="row">
            <div class="col-md-12">
                <div class="white_box broadcast_menu nps">
                    <ul>
                        <li><a class="active" href="#"><img src="{{ base_url() }}assets/images/ref_br_icon0_act.png">Select
                                Source</a></li>
                        <li><a href="javascript:void(0);"><img src="{{ base_url() }}assets/images/email_br_icon2.png">Rewards</a>
                        </li>
                        <li><a href="javascript:void(0);"><img src="{{ base_url() }}assets/images/email_br_icon3.png">Email
                                Workflow</a></li>
                        <li><a href="javascript:void(0);"><img src="{{ base_url() }}assets/images/email_br_icon4.png">Configuration</a>
                        </li>
                        <li><a href="javascript:void(0);"><img src="{{ base_url() }}assets/images/email_br_icon5.png">Integration</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--==================Broadcasts content============-->
        <div class="select_section" style="max-width: 100%;">

            <div class="row">
                <div class="col-md-4 text-center">
                    <label for="temp1" class="m0">
                        <div class="broadcast_select_contact">
                            <label class="custmo_checkbox">
                                <input class="check" type="radio" name="source_type" value="email"
                                       id="temp1" {!! ($oReferral->source_type == 'email' || $oReferral->source_type == '') ? 'checked' : '' !!}>
                                <span class="custmo_checkmark green_tr"></span>
                            </label>


                            <div class="img_box img_inactive"
                                 style="{{ ($oReferral->source_type == 'email' || $oReferral->source_type == '') ? 'display: none;' : '' }}">
                                <img src="{{ base_url() }}assets/images/ref_email.png"/>
                            </div>

                            <div class="img_box img_active "
                                 style="{{ ($oReferral->source_type == 'email' || $oReferral->source_type == '') ? '' : 'display: none;' }}">
                                <img src="{{ base_url() }}assets/images/ref_email_act.png"/>
                            </div>

                            <p class="fsize14 txt_dark fw500">Emails</p>
                            <p class="fsize12 txt_grey fw300">Select one or more of the pre-prepared contact lists. You
                                can create a new list of contacts in the “People” module.</p>
                        </div>
                    </label>
                </div>
                <div class="col-md-4 text-center">
                    <label for="temp2" class="m0">
                        <div class="broadcast_select_contact">
                            <label class="custmo_checkbox">
                                <input class="check" type="radio" name="source_type" id="temp2"
                                       value="sms" {!! $oReferral->source_type == 'sms' ? 'checked' : '' !!}>
                                <span class="custmo_checkmark green_tr"></span>
                            </label>
                            <div class="img_box img_inactive"
                                 style="{{ $oReferral->source_type == 'sms' ? 'display: none;' : '' }}">
                                <img src="{{ base_url() }}assets/images/ref_social.png"/>
                            </div>

                            <div class="img_box img_active "
                                 style="{{ $oReferral->source_type == 'sms' ? '' : 'display: none;' }}">
                                <img src="{{ base_url() }}assets/images/ref_social_act.png"/>
                            </div>

                            <p class="fsize14 txt_dark fw500">SMS</p>
                            <p class="fsize12 txt_grey fw300">Select all contacts that match a specific tag or group of
                                tags.</p>
                        </div>
                    </label>
                </div>
                <div class="col-md-4 text-center">
                    <label for="temp3" class="m0">
                        <div class="broadcast_select_contact">
                            <label class="custmo_checkbox">
                                <input class="check" type="radio" name="source_type" value="widget"
                                       id="temp3" {!! $oReferral->source_type == 'widget' ? 'checked' : '' !!}>
                                <span class="custmo_checkmark green_tr"></span>
                            </label>
                            <div class="img_box img_inactive"
                                 style="{{ $oReferral->source_type == 'widget' ? 'display: none;' : '' }}">
                                <img src="{{ base_url() }}assets/images/ref_widget.png"/>
                            </div>

                            <div class="img_box img_active "
                                 style="{{ $oReferral->source_type == 'widget' ? '' : 'display: none;' }}">
                                <img src="{{ base_url() }}assets/images/ref_widget_act.png"/>
                            </div>

                            <p class="fsize14 txt_dark fw500">Widgets</p>
                            <p class="fsize12 txt_grey fw300">Choose from all available contacts. The list of contacts
                                will be created automatically based on this broadcast.</p>
                        </div>
                    </label>
                </div>
            </div>

            <!--==================Button area============-->

            <div class="row">
                <div class="col-md-12">
                    <div class="mt30 mb30" style="height: 1px; border-bottom: 1px solid #eee;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">&nbsp;</div>
                <input type="hidden" name="refId" id="refId" value="{{ $moduleUnitID }}">
                <div class="col-md-6 text-right">
                    <button class="btn dark_btn bkg_dgreen2 h52 minw_160 updateSoucre">Next step <i
                            class="icon-arrow-right13 ml20"></i></button>
                </div>
            </div>
        </div>
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

                        <form name="frmInviteCustomer" id="frmInviteCustomer" method="post" action="">
                            @csrf
                            <input type="hidden" name="userid" value="{{ $userID }}"/>
                            <input type="hidden" name="bbaid" value="{{ $oSettings->hashcode }}"/>
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <div class="">
                                        <input name="firstname" id="firstname" class="form-control" type="text"
                                               required="">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <div class="">
                                        <input name="lastname" id="lastname" class="form-control" value="" type="text"
                                               required="">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <div class="">
                                        <input name="email" id="email" value="" class="form-control" type="text"
                                               required="">
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
        $(document).ready(function () {
            $(document).on("click", ".updateSoucre", function () {
                $('.overlaynew').show();
                var sourceType = $("input[name='source_type']:checked").val();
                var refId = $("#refId").val();
                $.ajax({
                    url: "{{ base_url('/admin/modules/referral/updateSource') }}",
                    type: "POST",
                    data: {source_type: sourceType, ref_id: refId, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            window.location.href = "{{ base_url('/admin/modules/referral/reward/') }}" + refId;
                        }
                    },
                    error: function (response) {
                        $('.overlaynew').hide();
                        alertMessage(response.message);
                    }
                });
            });

            $(document).on('click', '.publishReferralStatus', function () {

                var status = $(this).attr('status');
                $.ajax({
                    url: "{{ base_url('admin/modules/referral/publishReferralStatus') }}",
                    type: "POST",
                    data: {'ref_id': '{{ $moduleUnitID }}', 'status': status, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            if (status == 'active') {

                                displayMessagePopup('success', 'Campaign pushlished successfully');
                            } else {
                                displayMessagePopup('success', 'Campaign saved as draft successfully');
                            }

                        } else {
                            alertMessage('Error: Some thing wrong!');
                        }
                    }
                });

            });

            $("#frmInviteCustomer").submit(function () {
                $('.overlaynew').show();
                var formData = new FormData($(this)[0]);
                $('#btnInvite').prop("disabled", true);
                $.ajax({
                    url: "{{ base_url('admin/modules/referral/registerInvite') }}",
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

            $('.check').change(function () {
                $('.broadcast_select_contact').find(".img_inactive").show();
                $('.broadcast_select_contact').find(".img_active").hide();
                if ($(this).prop("checked")) {
                    $(this).parent().parent().find(".img_inactive").hide();
                    $(this).parent().parent().find(".img_active").show();
                } else {
                    $(this).parent().parent().find(".img_inactive").show();
                    $(this).parent().parent().find(".img_active").hide();
                }
            });
        });
    </script>
@endsection
