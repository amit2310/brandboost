<template>

    <div>

        <!--Top Heading area-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Email Templates</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/emailfilter.svg"/></button>
                        <button class="btn btn-md bkg_email_300 light_000 slidebox"> Create new <span style="opacity: 0.3"><img src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--Content Area-->
        <div class="content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 email_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_email_000 mr10"><img src="/assets/images/download-fill-email.svg"/></span>
                                        Import template
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="/assets/images/question-line.svg"/></span>
                                        Learn how to use segments
                                    </a>
                                </div>
                            </div>


                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="/assets/images/email-template.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No templates so far. But you can change it!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import templates!</h3>
                                    <button class="btn btn-sm bkg_email_000 pr20 email_400 slidebox">Add template</button>
                                </div>
                            </div>






                        </div>
                    </div>
                </div>


            </div>

        </div>



        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="/assets/images/email_temp_icons.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Create Email Template </h3>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <form action="/action_page.php">
                                    <div class="form-group">
                                        <label for="fname">Form name</label>
                                        <input type="text" class="form-control h56" id="fname" placeholder="Enter name" name="fname">
                                    </div>



                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="List description"></textarea>
                                    </div>



                                </form>
                            </div>
                        </div>

                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-lg bkg_email_400 light_000 pr20 min_w_160 fsize16 fw600">Create</button>
                                <a class="dark_300 fsize16 fw400 ml20" href="#">Close</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>

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
                <email-templates :pageColor="pageColor" v-if="type == 'email'"></email-templates>
                <sms-templates :pageColor="pageColor" v-if="type == 'sms'"></sms-templates>
            </div>
        </div>


</template>

<script>
    import EmailTemplates from './EmailTemplates.vue';
    import SmsTemplates from './SmsTemplates.vue';

    export default {
        props: ['pageColor', 'title', 'type'],
        components: {'email-templates': EmailTemplates, 'sms-templates': SmsTemplates},
        mounted() {

        }
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

