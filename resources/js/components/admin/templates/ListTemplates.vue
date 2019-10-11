<template>
        <div class="content">

            <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
            <div class="page_header">
                <div class="row">
                    <!--=============Headings & Tabs menu==============-->
                    <div class="col-md-3 mt20">
                        <h3><img src="/assets/images/people_sec_icon.png"> {{ title }}</h3>

                    </div>
                    <!--=============Button Area Right Side==============-->
                    <div class="col-md-9 text-right btn_area">
                        <button type="button" class="btn dark_btn dropdown-toggle ml10 addUserTemplate"
                                :template-type="type"><i class="icon-plus3"></i><span> &nbsp;  Add Template</span>
                        </button>

                    </div>
                </div>
            </div>
            <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

            <div class="tab-content">
                <email-templates v-if="type == 'email'"></email-templates>
                <sms-templates v-if="type == 'sms'"></sms-templates>
            </div>
        </div>


</template>

<script>
    import EmailTemplates from './EmailTemplates.vue';
    import SmsTemplates from './SmsTemplates.vue';

    export default {
        props: ['title', 'type'],
        components: {'email-templates': EmailTemplates, 'sms-templates': SmsTemplates}
    };

    let tkn = $('meta[name="_token"]').attr('content');

    $(document).ready(function () {
        $(document).on("click", ".cloneTemplate", function (e) {
            var templateId = $(this).attr('template_id');
            var templateType = $(this).attr('template_type');
            if (confirm("Are you sure you want to clone this template?")) {
                if (templateId != '') {
                    $('.overlaynew').show();
                    $.ajax({
                        url: "/admin/templates/cloneTemplate",
                        type: "POST",
                        data: {_token: tkn, templateId: templateId, templateType: templateType},
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
                        url: "/admin/templates/deleteTemplate",
                        type: "POST",
                        data: {_token: tkn, templateId: templateId},
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
                url: "/admin/templates/addUserTemplate",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        displayMessagePopup("success", "Success", "Template created successfully!");
                        window.location.href = "/admin/templates/edit/" + data.id;
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

        $(document).on("blur", ".editNameTxt", function () {
            $(".editName").show();
            $(".editNameTxt").hide();
        });

        $(document).on("change", ".editNameTxt", function () {
            var templateId = $(this).attr('template_id');
            var elem = $(this);
            var templateName = $(this).val();
            $.ajax({
                url: "/admin/templates/updateUserTemplateName",
                type: "POST",
                data: {_token: tkn, templateId: templateId, templateName: templateName},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        displayMessagePopup("success", "Success", "Name updated successfully!");
                        $(elem).hide();
                        $("#editName_" + templateId).show();
                        $("#editName_" + templateId).html(templateName);
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        displayMessagePopup("error", "Duplicate Template", data.msg);
                    }

                }
            });
        });
    });

</script>
<style>
    .template_preview.sms .custmo_checkbox {
        display: none !important;
    }

    .template_preview .custmo_checkbox {
        display: none !important;
    }

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
