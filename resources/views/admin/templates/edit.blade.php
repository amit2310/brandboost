@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<style>
    .app-loader {
        display: flex;
        align-items: center;
        height: 100% !important;
        margin-top: -65px;
        margin-left:40%;
        position: fixed;
        z-index: 99999;
    }
    .loader-z {
        width: 50px;
        height: 50px;
        margin: 0 auto;
        border-radius: 50%;
        border-top-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
        box-shadow: 1px 1px 0px rgb(49, 203, 75);
        animation: cssload-spin 690ms infinite linear;
        -o-animation: cssload-spin 690ms infinite linear;
        -ms-animation: cssload-spin 690ms infinite linear;
        -webkit-animation: cssload-spin 690ms infinite linear;
        -moz-animation: cssload-spin 690ms infinite linear;
    }
</style>
<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3 mt20">
                <h3><img src="{{ base_url() }}assets/images/people_sec_icon.png"> <?php echo $title; ?></h3>

            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
                <a href="<?php echo base_url(); ?>admin/templates/<?php echo $templateType; ?>" class="btn dark_btn ml10" style="padding-top:10px!important;"><i class="icon-indent-decrease2"></i><span> &nbsp;  All Template</span> </a>  
                <button type="button" class="btn dark_btn dropdown-toggle ml10 saveUserTemplate" template-type="<?php echo $templateType; ?>"><i class="icon-plus3"></i><span> &nbsp;  Save Template</span> </button>  

            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <?php if ($templateType == 'email'): ?>
        <div class="tab-content">
            <div id="zloader">
                <div class="loader-c app-loader">
                    <div class="loader-z"></div>
                </div>
            </div>
            <iframe src="<?php echo base_url(); ?>admin/templates/loadEmailTemplate/<?php echo $templateID; ?>" id="userTemplateEditArea" width="100%" height="1800" scrolling="no" style="border:none !important;overflow:hidden;display:none;"></iframe>

        </div>
    <?php endif; ?>

    <?php if ($templateType == 'sms'): ?>
        <div class="tab-content"> 
            <div id="zloader">
                <div class="loader-c app-loader">
                    <div class="loader-z"></div>
                </div>
            </div>
            <iframe src="<?php echo base_url(); ?>admin/templates/loadSMSTemplate/<?php echo $templateID; ?>" id="userTemplateEditArea" width="100%" height="1800" scrolling="no" style="border:none !important;overflow:hidden;display:none;"></iframe>

        </div>
    <?php endif; ?>
</div>

<!-- /content area -->

<div id="addUserTemplate" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddUserTemplateModal" id="frmAddUserTemplateModal" action="javascript:void();">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> Add <?php echo $title; ?> &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Enter Template Name below:</label>
                                <input class="form-control" id="title" name="templateName" placeholder="Enter Title" type="text" required>

                            </div>

                            <div class="form-group mb0">
                                <label>Choose Template Category:</label>
                                <select class="form-control h52" name="templateCategory" required="">
                                    <option>--Select--</option>
                                    <?php
                                    if (!empty($oCategories)) {
                                        foreach ($oCategories as $oCategory) {
                                            ?>
                                            <option value="<?php echo $oCategory->id; ?>"><?php echo $oCategory->category_name; ?></option>                 
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="templateType" value="<?php echo $templateType; ?>" />
                    <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>

<div id="wfSendTestEmail" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> &nbsp;Send Test Email <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input class="form-control" id="wfTextPopupSendTestEmail" placeholder="Email" type="text" required>                          

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="wf_test_email_campaign_id" />
                <button type="button" id="wfBtnPopupSendTestEmail" class="btn dark_btn bkg_sblue fsize14">Send Email</button>
            </div>

        </div>
    </div>
</div>


<div id="wfSendTestSMS" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Sms_Color.svg"/> &nbsp;Send Test SMS <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input class="form-control" id="wfTextPopupSendTestSMS" placeholder="Phone Number" type="text" value="<?php echo $oUser->mobile; ?>" required>                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="wf_test_sms_campaign_id" />
                <button type="button" id="wfBtnPopupSendTestSMS" class="btn dark_btn bkg_sblue fsize14">Send SMS</button>
            </div>

        </div>
    </div>
</div>

<div id="emaileditorinfo" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> &nbsp;How to use this editor <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <b>Brandboost Email Builder</b> We will revert back to you very soon with detailed document and help videos
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark_btn bkg_sblue fsize14">Close</button>
            </div>

        </div>
    </div>
</div>

<div id="smseditorinfo" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Sms_Color.svg"/> &nbsp;How to use this sms editor <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <b>Brandboost SMS Editor</b> We will revert back to you very soon with detailed document and help videos
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark_btn bkg_sblue fsize14">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        setTimeout(function () {
            $("#userTemplateEditArea").show();
            $("#zloader").hide();
        }, 3000);
        $(document).on("click", "#wfBtnPopupSendTestEmail", function () {
            var email = $("#wfTextPopupSendTestEmail").val();
            var templateId = '<?php echo $templateID; ?>';
            $('.overlaynew').show();
            $.ajax({
                url: '/admin/templates/sendTestEmail',
                type: "POST",
                data: {_token: '{{csrf_token()}}', templateId: templateId, email: email},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        displayMessagePopup('success', 'Success', 'Test email sent successfully'); //javascript notification msg (edited) 
                        $("#wfSendTestEmail").modal("hide");
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on("click", "#wfBtnPopupSendTestSMS", function () {
            var number = $("#wfTextPopupSendTestSMS").val();
            var templateId = '<?php echo $templateID; ?>';
            $('.overlaynew').show();
            $.ajax({
                url: '/admin/templates/sendTestSMS',
                type: "POST",
                data: {_token: '{{csrf_token()}}', templateId: templateId, number: number},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        displayMessagePopup("success", "Success", "Test SMS sent successfully!");
                        $("#wfSendTestSMS").modal("hide");
                        $('.overlaynew').hide();
                    }
                }
            });
        });
        $(".saveUserTemplate").click(function () {
            $("#userTemplateEditArea").contents().find("#saveEditorChanges").trigger("click");
        });
        $(".addUserTemplate").click(function () {
            $("#addUserTemplate").modal("show");
        });
        $('#frmAddUserTemplateModal').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmAddUserTemplateModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/templates/addUserTemplate'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        displayMessagePopup("success", "Success", "Template created successfully!");
                        window.location.href = '<?php echo base_url('admin/templates/edit/'); ?>' + data.id;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        displayMessagePopup("error", "Duplicate Template", data.msg);
                    }

                }
            });
            return false;
        });
    });

</script>
@endsection


