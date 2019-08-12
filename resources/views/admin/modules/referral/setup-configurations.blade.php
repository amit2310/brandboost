@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
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
                    <li><a href="<?php echo base_url(); ?>admin/modules/referral/reward/<?php echo $moduleUnitID; ?>"><img src="<?php echo base_url(); ?>assets/images/email_br_icon2.png">Rewards</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/modules/referral/workflow/<?php echo $moduleUnitID; ?>"><img src="<?php echo base_url(); ?>assets/images/email_br_icon3.png">Email Workflow</a></li>
                    <li><a class="active" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/email_br_icon4_act.png">Configuration</a></li>
                    <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/email_br_icon5.png">Integration</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="select_section" style="max-width: 100%;">
        <form name="frmSettings" method="post" id="frmSettings">
			{{ csrf_field() }}
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">General</h6>
                            <div class="heading-elements"><a href="#"><img src="/assets/images/more.svg"/></a></div>
                        </div>
                        <div class="panel-body p0">

                            <div class="bbot p20">
                                <div class="form-group">
                                    <label class="control-label">Campaign Name</label>
                                    <div class="">
                                        <input name="referral_title" id="referral_title" class="form-control autoSave" value="<?php echo $oReferral->title != '' ? $oReferral->title : ''; ?>" type="text" placeholder="Referral Title">
                                    </div>
                                </div>


                            </div>
                            <div class="bbot p20">

                                <input type="hidden" name="refid" id="refid" value="<?php echo $programID; ?>" />
                                <div class="form-group">
                                    <label>Store Name <?php echo $defalutTab; ?></label>
                                    <div class="">
                                        <input type="text" class="form-control autoSave" name="storeName" value="<?php if(!empty($oAccountSettings)){ echo $oAccountSettings->store_name != '' ? $oAccountSettings->store_name : ''; } ?>" placeholder="Your store name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Store URL</label>
                                    <div class="">
                                        <input type="text" class="form-control autoSave" name="storeURL" value="<?php if(!empty($oAccountSettings)){ echo ($oAccountSettings->store_url) ? ($oAccountSettings->store_url) : ''; } ?>" placeholder="Your store url e.g. http://mystorename.com">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <div class="">
                                        <input type="text" class="form-control autoSave" name="storeEmail" value="<?php if(!empty($oAccountSettings)){ echo ($oAccountSettings->store_email) ? ($oAccountSettings->store_email) : ''; } ?>" placeholder="Your store email address">
                                    </div>
                                </div>

                            </div>
                            <div class="p20 hidden">
                                <button type="submit" class="btn dark_btn w100 bkg_green configSetting">Save &amp; Continue</button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Sharing Content</h6>
                            <div class="heading-elements"><a href="#"><img src="/assets/images/more.svg"/></a></div>
                        </div>
                        <div class="panel-body p0">
                            <div class="">
                                <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right22">
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings active">
                                            <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right22" href="#accordion-control-right-group1111"><i class="icon-facebook"></i>Facebook</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group1111" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Facebook Title</label>
                                                            <div class="">
                                                                <input name="facebook_title" id="facebook_title" class="form-control autoSave" type="text" placeholder="Apple iPhone XR" value="<?php if(!empty($oAccountSettings)){ echo ($oAccountSettings->facebook_title) ? ($oAccountSettings->facebook_title) : ''; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Facebook Descriptions</label>
                                                            <div class="">

                                                                <textarea name="facebook_desc" id="facebook_desc" rows="4" class="form-control autoSave" placeholder="The iPhone XR display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 5.85 inches diagonally (actual viewable area is less)."><?php if(!empty($oAccountSettings)){ echo ($oAccountSettings->facebook_desc) ? ($oAccountSettings->facebook_desc) : ''; } ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right22" href="#accordion-control-right-group2222"><i class="icon-twitter"></i>Twitter</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group2222" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Twitter Title</label>
                                                            <div class="">
                                                                <input name="twitter_title" id="twitter_title" class="form-control autoSave" type="text" placeholder="Apple iPhone XR" value="<?php if(!empty($oAccountSettings)){ echo ($oAccountSettings->twitter_title) ? ($oAccountSettings->twitter_title) : ''; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Twitter Descriptions</label>
                                                            <div class="">

                                                                <textarea rows="4" name="twitter_desc" id="twitter_desc" class="form-control autoSave" placeholder="The iPhone XR display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 5.85 inches diagonally (actual viewable area is less)."><?php if(!empty($oAccountSettings)){ echo ($oAccountSettings->twitter_desc) ? ($oAccountSettings->twitter_desc) : ''; } ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right22" href="#accordion-control-right-group3333"><i class="icon-mention"></i>Email / Link</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group3333" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Email Id / Link</label>
                                                            <div class="">
                                                                <input name="site_link" id="site_link" class="form-control autoSave" type="text" placeholder="" value="<?php if(!empty($oAccountSettings)){ echo ($oAccountSettings->site_link) ? ($oAccountSettings->site_link) : ''; } ?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">settings</h6>
                            <div class="heading-elements"><a href="#"><img src="/assets/images/more.svg"/></a></div>
                        </div>
                        <div class="panel-body p0">
                            <div class="p25 bbot">
                                <div class="form-group mb0">
                                    <label class="control-label pull-left">Active Campaign</label>
                                    <label class="custom-form-switch pull-right">
                                        <input class="field autoSave" type="checkbox" name="referralStatus" value="1" <?php echo $oReferral->status == 'active' ? 'checked' : ""; ?>>
                                        <span class="toggle teal"></span> 
                                    </label>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <input type="hidden" name="refId" id="refId" value="<?php echo $moduleUnitID; ?>">
            <div class="col-md-6"><button class="btn btn_white bkg_white h52 txt_dark minw_140 shadow br5 backPage"><i class="icon-arrow-left12 mr20"></i> Back</button></div>
            <div class="col-md-6 text-right"><button class="btn dark_btn bkg_dgreen2 h52 minw_160 continueSummary">Next step <i class="icon-arrow-right13 ml20"></i></button></div>
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
    $(document).ready(function () {
        $(document).on("click", ".continueSummary", function () {
            $('.overlaynew').show();
            var refId = $("#refId").val();
            window.location.href = '<?php echo base_url('/admin/modules/referral/integrations/'); ?>' + refId;
        });

        $(".backPage").click(function () {
            var refId = $('#refId').val();
            $('.overlaynew').show();
            window.location.href = '<?php echo base_url('/admin/modules/referral/workflow/'); ?>' + refId;
        });

        $(document).on('change', '.autoSave', function () {
            $('.configSetting').trigger('click');
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

        $("#frmSettings").submit(function () {
            var formData = new FormData($(this)[0]);
            $('#saveSettings').prop("disabled", true);
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/saveSettings'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
                        displayMessagePopup();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.publishReferralStatus', function () {

            var status = $(this).attr('status');
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/publishReferralStatus'); ?>',
                type: "POST",
                data: {'ref_id': '<?php echo $moduleUnitID; ?>', 'status': status, _token: '{{csrf_token()}}'},
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

    });
</script>
@endsection