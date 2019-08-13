@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<!--########################TAB 4 ##########################-->
<style type="text/css">
    .workflow_main_box .panel-heading.bkg_grey_light{display:none!important;}
</style>
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

                <!-- <button style="padding: 7px 15px!important;"  type="button" class="btn dark_btn" data-toggle="modal" data-target="#addPeopleList"><i class="icon-plus3 txt_green3"></i></button> -->
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
                    <li><a class="active" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/email_br_icon3_act.png">Email Workflow</a></li>
                    <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/email_br_icon4.png">Configuration</a></li>
                    <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/email_br_icon5.png">Integration</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="select_section" style="max-width: 100%;">
		@include('admin.workflow2.tree', array('oEvents' => $oEvents))
        <div class="row">
            <input type="hidden" name="refId" id="refId" value="<?php echo $moduleUnitID; ?>">
            <div class="col-md-6"><button class="btn btn_white bkg_white h52 txt_dark minw_140 shadow br5 backPage"><i class="icon-arrow-left12 mr20"></i> Back</button></div>
            <div class="col-md-6 text-right"><button class="btn dark_btn bkg_dgreen2 h52 minw_160 continueConfig">Next step <i class="icon-arrow-right13 ml20"></i></button></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
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
                        <input type="hidden" name="userid" value="<?php echo $userID; ?>" />
                        <input type="hidden" name="bbaid" value="<?php echo $oSettings->hashcode; ?>" />
						{{ csrf_field() }}
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
@include('admin.modals.workflow2.workflow-popup', array('oDefaultTemplates' => $oDefaultTemplates))

<script>
    $(document).ready(function () {
        $(document).on("click", ".continueConfig", function () {
            $('.overlaynew').show();
            var refId = $("#refId").val();
            window.location.href = '<?php echo base_url('/admin/modules/referral/configurations/'); ?>' + refId;
        });

        $(".backPage").click(function () {
            var refId = $('#refId').val();
            $('.overlaynew').show();
            window.location.href = '<?php echo base_url('/admin/modules/referral/reward/'); ?>' + refId;
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

        $(document).on('click', '.publishReferralStatus', function () {

            var status = $(this).attr('status');
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/publishReferralStatus'); ?>',
                type: "POST",
                data: {'ref_id': '<?php echo $moduleUnitID; ?>', 'status': status, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //window.location.href = '<?php echo base_url('admin/brandboost/onsite'); ?>';
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