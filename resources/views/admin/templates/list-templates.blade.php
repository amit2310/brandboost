<!-- Content area -->
<style>
    .template_preview.sms .custmo_checkbox {display:none !important;}
    .template_preview .custmo_checkbox {display:none!important;}
    .template_preview .custmo_checkbox
    .email_preview_button.clone {
        position: absolute;
        width: 64px;
        height: 64px;
        box-shadow: 0 6px 8px 0 rgba(1, 21, 64, 0.16);
        background: #fff;
        border-radius: 100%;
        text-align: center;
        line-height: 64px;
        top: 54%;
        margin-top: 0px;
        left: 50%;
        margin-left: -32px;
        color: #2b9adc;
        display: block;
    }
</style>
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3 mt20">
                <h3><img src="<?php echo base_url() ?>assets/images/people_sec_icon.png"> <?php echo $title; ?></h3>

            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
                <button type="button" class="btn dark_btn dropdown-toggle ml10 addUserTemplate" template-type="<?php echo $templateType; ?>"><i class="icon-plus3"></i><span> &nbsp;  Add Template</span> </button>  

            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <?php if ($templateType == 'email'): ?>
            <?php $this->load->view('admin/templates/emails/email-template-index'); ?>
        <?php endif; ?>

        <?php if ($templateType == 'sms'): ?>
            <?php $this->load->view('admin/templates/sms/sms-template-index'); ?>
        <?php endif; ?>

    </div>
</div>

<!-- /content area -->

<div id="addUserTemplate" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddUserTemplateModal" id="frmAddUserTemplateModal" action="javascript:void();">
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

<script>


    $(document).ready(function () {
        $(document).on("click", ".cloneTemplate", function (e) {
            var templateId = $(this).attr('template_id');
            var templateType = $(this).attr('template_type');
            if (confirm("Are you sure you want to clone this template?")) {
                if (templateId != '') {
                    $('.overlaynew').show();
                    $.ajax({
                        url: '<?php echo base_url('admin/templates/cloneTemplate'); ?>',
                        type: "POST",
                        data: {templateId: templateId, templateType: templateType},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'success') {
                                $('.overlaynew').hide();
                                displayMessagePopup("success", "Success", "Template cloned and saved into your templates!");
                                if ($(".displaySMSTemplates[action='my']").hasClass("active")) {
                                    $(".displaySMSTemplates[action='my']").trigger("click");
                                }

                                if ($(".displayEmailTemplates[action='my']").hasClass("active")) {
                                    $(".displayEmailTemplates[action='my']").trigger("click");
                                }
                            } else if (data.status == 'error') {
                                $('.overlaynew').hide();

                            }

                        }
                    });

                }
            }

        });



        $(document).on("click", ".deleteTemplate", function () {
            var elem = $(this);
            deleteConfirmationPopup(
                    "This record will deleted immediately.<br>You can't undo this action.",
                    function () {
                        $('.overlaynew').show();
                        var templateId = $(elem).attr('template_id');
                        $.ajax({
                            url: '<?php echo base_url('admin/templates/deleteTemplate'); ?>',
                            type: "POST",
                            data: {templateId: templateId},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    $('.overlaynew').hide();
                                    displayMessagePopup("success", "Success", "Template was deleted successfully!");
                                    $(".displaySMSTemplates[action='my']").trigger("click");
                                    $(".displayEmailTemplates[action='my']").trigger("click");

                                }
                            }
                        });
                    });

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

        $(document).on("click", ".editName", function () {
            $(".editName").show();
            $(".editNameTxt").hide();
            var templateID = $(this).attr('template_id');
            $(this).hide();
            $("#editNameTxt_" + templateID).show();
            $("#editNameTxt_" + templateID).focus();
        });
        
        $(document).on("blur", ".editNameTxt", function(){
            $(".editName").show();
            $(".editNameTxt").hide();
        });

        $(document).on("change", ".editNameTxt", function () {
            var templateId = $(this).attr('template_id');
            var elem = $(this);
            var templateName = $(this).val();
            $.ajax({
                url: '<?php echo base_url('admin/templates/updateUserTemplateName'); ?>',
                type: "POST",
                data: { templateId:templateId, templateName:templateName},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        displayMessagePopup("success", "Success", "Name updated successfully!");
                        $(elem).hide();
                        $("#editName_" + templateId).show();
                        $("#editName_"+ templateId).html(templateName);
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        displayMessagePopup("error", "Duplicate Template", data.msg);
                    }

                }
            });



        });
    });

</script>


