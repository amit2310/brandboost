@php
    $draftID = !empty($draftID) ? $draftID : '';
    $moduleName = !empty($moduleName) ? $moduleName : '';
    $html = !empty($html) ? $html : '';
    $css = !empty($css) ? $css : '';
    $campaignID = !empty($campaignID) ? $campaignID : '';
    $template_source = !empty($template_source) ? $template_source : '';

@endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SMS Editor</title>

    <!-- Global stylesheets -->
    <link rel="stylesheet" href="//unpkg.com/grapesjs@0.10.7/dist/css/grapes.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/6448636/7432192/css/fonts.css"/>
    <link href="{{ base_url() }}assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="{{ base_url() }}assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="{{ base_url() }}assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="{{ base_url() }}assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="{{ base_url() }}assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="{{ base_url() }}assets/css/theme1.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ base_url() }}assets/grapes/dist/grapesjs-preset-newsletter.css">
    <style type="text/css">
        .dataTables_filter {
            display: none;
        }

        .starGray {
            color: #dbdcdd !important;
        }

        .starGray:hover {
            color: #4285f4 !important;
        }

    </style>
    <style>
        .mobile_sms_bkg {
            background: url({{ base_url() }}assets/images/iphone.png) center top no-repeat;
            width: 357px;
            height: 716px;
            margin: 0 auto;
            padding: 70px 40px;
        }

        .btn.dark_btn {
            color: #fff !important;
        }
    </style>
    <style>
        .email_editor_left, .email_editor_right {
            background: #fff;
            padding: 0;
            border-radius: 5px !important;
            min-height: 1020px;
            overflow: hidden;
        }

        .email_editor_left .form-group {
            margin-bottom: 8px
        }

        .email_editor_left .open_editor {
            color: #2b97dd;
            position: absolute;
            top: 43px;
            z-index: 9;
            left: 20px;
            border-bottom: 1px solid #ebeff6;
            padding-bottom: 10px;
            display: block;
            min-width: 277px;
        }

        .email_preview_sec {
            background: #f4f6fa;
            padding: 30px;
            min-height: 677px;
        }

        .email_preview_sec .email_content {
            width: 100%;
            box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
            background-color: #fff;
            margin-bottom: 10px;
            border-radius: 4px;
            text-align: center;
            padding-bottom: 30px;
        }

        .email_preview_sec .email_content .blue_header {
            width: 100%;
            border-radius: 4px 4px 0 0;
            height: 74px;
            box-shadow: 0 1px 1px 0 rgba(43, 151, 221, 0.2), 0 2px 4px 0 rgba(43, 151, 221, 0.04), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05), inset 0 1px 0 0 rgba(255, 255, 255, 0.1);
            background-image: linear-gradient(to bottom, #2eb4dd, #2779dc);
        }

        .email_preview_sec .email_content img.company {
            width: 66.7px;
            height: 66.7px;
            box-shadow: 0 3px 0 0 rgba(0, 0, 0, 0.09);
            border-radius: 100px;
            margin-top: -33px;
        }

        .email_preview_sec .email_content h2 {
            margin: 20px 0 13px 0;
            font-size: 14px;
            font-weight: 500;
        }

        .email_preview_sec .email_content .fa.fa-star {
            font-size: 40px;
            color: #f4f6fa;
            margin: 0 8px;
        }

        .email_preview_sec .email_content .fa.fa-star.active {
            color: #46a9f6
        }

        .email_preview_sec .email_foot p {
            font-size: 7px;
            color: #79828b;
            font-family: arial;
            text-align: center;
        }

        .email_editor .inner_sec_email_edit {
            background: #fff;
            padding: 0;
            border-radius: 5px !important;
        }

        .modal-body .editor_btn .btn.btn-xs.btn_white_table {
            margin: 0 10px 0px 0 !important;
        }

        .preview_switch {
            position: absolute;
            right: 20px;
            top: 21px;
        }

        .preview_switch_icon {
            background: #fff;
            border-radius: 4px;
            width: 22px;
            height: 22px;
            display: inline-block;
            text-align: center;
            line-height: 23px;
            color: #ddd;
            font-size: 11px;
        }

        .preview_switch_icon i {
            font-size: 11px;
        }

        .preview_switch_icon.active {
            color: #96ccee;
            background: #eef7fd
        }

        ul.editor_text_option {
            margin: 0;
            padding: 0;
        }

        ul.editor_text_option li {
            list-style: none;
            margin: 0 17px 0 0;
            padding: 0 17px 0 0;
            display: inline-block;
            font-size: 14px;
            color: #202040;
            border-right: 1px solid #eee;
        }

        ul.editor_text_option li a {
            color: #7a8dae !important;
            font-size: 14px;
            font-weight: 600;
            padding: 0 7px;
        }

        ul.editor_text_option li a i {
            font-size: 13px !important
        }

        ul.editor_text_option li select {
            border: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 75px;
            background: url(assets/images/select_bkg.png) right 10px no-repeat #fff;
        }

        ul.editor_text_option li:last-child {
            border: none !important;
            margin: 0;
            padding: 0;
        }

        #backtoTree {
            background: #eb4f76 !important;
            color: #ffffff !important;
            float: left;
            margin-left: 40px;
            margin-top: 20px !important;
            height: 40px !important;
            padding: 5px 30px 5px !important;
        }

        #backtoTree:hover {
            background: #2f3053 !important;
        }
    </style>


    <script type="text/javascript" src="{{ base_url() }}assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="{{ base_url() }}assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="{{ base_url() }}assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ base_url() }}assets/js/plugins/loaders/blockui.min.js"></script>

</head>
<style>
    body, html {
        height: 100%;
        margin: 0;
        overflow: hidden;
    }

    .nl-link {
        color: inherit;
    }

    .info-link {
        text-decoration: none;
    }

    #info-cont {
        line-height: 17px;
    }

    .grapesjs-logo {
        display: block;
        height: 90px;
        margin: 0 auto;
        width: 90px;
    }

    .grapesjs-logo path {
        stroke: #eee !important;
        stroke-width: 8 !important;
    }

    #toast-container {
        font-size: 13px;
        font-weight: lighter;
    }

    #toast-container > div,
    #toast-container > div:hover {
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        font-family: Helvetica, sans-serif;
    }

    #toast-container > div {
        opacity: 0.95;
    }

    #externalSystemContainer {
        background-color: #fff;
        padding: 10px 20px;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
        text-align: right;
    }

    #undoButton, #redoButton {
        display: none;
    }

    #stripoSettingsContainer {
        width: 400px;
        float: left;
    }

    #stripoPreviewContainer {
        width: calc(100% - 400px);
        float: left;
    }

    .notification-zone {
        position: fixed;
        width: 400px;
        z-index: 99999;
        right: 20px;
        bottom: 80px;
    }

    .control-button {
        display: inline-block;
        border-radius: 5px;
        font-size: 13px !important;
        background: #4285f4 !important;
        border: none;
        height: 30px;
        padding: 4px 13px 5px !important;
        font-weight: 600;
        color: #fff;
        line-height: 18px;
        margin-right: 5px;
        /*font-family: 'Inter UI'!important;*/
        box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05) !important;
    }

    .control-button:hover {
        background: #2f3053 !important;
    }

    .control-button-red {
        display: inline-block;
        border-radius: 5px;
        font-size: 13px !important;
        background-color: #eb4f76 !important;
        border: none;
        height: 30px;
        padding: 4px 13px 5px !important;
        font-weight: 600;
        color: #fff;
        line-height: 18px;
        margin-right: 5px;
        /*font-family: 'Inter UI'!important;*/
        box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05) !important;
    }

    #codeEditor {
        float: left !important
    }

    #saveStripoChanges, #saveStripoDraft, #saveToMyTemplates {
        float: right;
        margin-left: 10px;
        margin-top: 20px;
    }

    .control-button:hover {
        background: #237ec0
    }

    #changeHistoryLink {
        cursor: pointer;
    }

    .form-group {
        padding: 0 20px !important;
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 5px !important;
        border: 1px solid #ddd !important;
    }

    .app-loader {
        display: flex;
        align-items: center;
        height: 100% !important;
        margin-top: -65px;
        margin-left: 50%;
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
@php
    $aUser = getLoggedUser();
@endphp
<body>

<div style="display:none;width:100%;float:right;margin-right: 20px;margin-bottom:20px;overflow:hidden;">
    @php //if ($moduleName == 'automation' || $moduleName == 'broadcast'): @endphp
    <button id="backtoTree" class="control-button-red"><&nbsp;&nbsp;<span>Back</span></button>
    @php //endif @endphp
    <button id="saveStripoChanges" class="control-button">Save SMS</button>
    @if ($moduleName == 'automation' || $moduleName == 'broadcast')
        <button id="saveToMyTemplates" class="control-button mt20" style="height:40px;">Save to my templates</button>
        <input type="hidden" id="draft_id" name="draft_id" value="{{ $draftID }}"/>
    @endif
</div>
<div id="gjs" style="margin-bottom:20px!important;">

    <div class="row">
        <div class="col-md-4 pr0">
            <div class="email_editor_left" style="">
                <!--                        <div class="p10 bbot">
                                            <div class="gjs-pn-buttons">
                                                <span title="" class="gjs-pn-btn fa fa-cog gjs-pn-active" data-tooltip="Settings"></span>
                                                <span title="" class="gjs-pn-btn fa fa-bars" data-tooltip="Open Layer Manager"></span>
                                            </div>
                                        </div>-->
                <div class="p20">
                    <div class="form-group pb20">
                        <label class="">Language</label>
                        <select class="form-control h52">
                            <option>English USA</option>

                        </select>
                    </div>

                    <div class="form-group mb0">
                        <label class="">Content</label>
                        <a class="fsize14 open_editor ml20" href="#">
                            <i class=""><img src="{{ base_url() }}assets/images/open_editor.png"/> </i> &nbsp; SMS
                            editor</a>
                        <textarea name="smsWorkflowCampaignBody" id="smsWorkflowCampaignBody"
                                  style="min-height: 525px; resize: none; padding-top: 58px!important;"
                                  class="form-control p20 fsize12">{{ str_replace("<br>", "\n", base64_decode($compiledSource)) }}</textarea>
                    </div>
                    @if (!empty($oCampaignTags))
                        <div class="form-group" style="display:none;">
                            <div class="note-btn-group btn-group note-view">
                                @foreach ($oCampaignTags as $oTags)
                                    <button type="button" data-toggle="tooltip" title="Click to insert Tag"
                                            data-tag-name="{{ $oTags }}"
                                            class="btn btn-default add_btn draggable insert_tag_button">{{ $oTags }}</button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="p20 pt0" id="wfSMSActiveCtrEdit" style="display: none;">

                    <input type="hidden" name="wf_editor_campaign_id" id="wf_sms_editor_campaign_id"
                           value="{{ $campaignID }}">
                    <input type="hidden" name="wf_editor_moduleName" id="wf_sms_editor_moduleName"
                           value="{{ $moduleName }}">
                    <button type="button" id="updateWorkflowSmsCampaign" class="btn dark_btn bkg_sblue fsize14">Save
                    </button>
                    <a href="javascript:void(0);" id="wfOpenSMSTestCtrEdit" class="btn btn-link fsize14">Send test
                        sms</a>

                </div>
                <div class="p20 pt0" id="wfSMSTestCtrEdit" style="display:none;">
                    <input type="text" class="mr20" id="wf_preview_edit_sms_template_text_number_Edit"
                           placeholder="Phone Number" value="{{ $aUser->mobile }}"
                           style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;"/>
                    <button type="button" id="wf_preview_edit_sms_template_send_sms_Edit"
                            class="btn dark_btn bkg_sblue fsize14">Send
                    </button>
                    <button type="button" id="wfCloseSMSTestCtrEdit" class="btn dark_btn bkg_red fsize14">Cancel
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8 pl3">
            <div class="email_editor_right preview" style="max-height:1000px;overflow:hidden;">
                <div class="p10 bbot position-relative pull-right" style="width:100%;">
                    <div class="gjs-pn-buttons pull-right">

                        <span title="FullScreen" data-tooltip-pos="bottom"
                              class="gjs-pn-btn fa fa-arrows-alt gjs-pn-active viewfullscreen"
                              data-tooltip="Fullscreen"></span>
                        <span title="" data-tooltip-pos="bottom" class="gjs-pn-btn fa fa-paper-plane sendTestSMS"
                              campaign_id='{{ $campaignID }}' data-tooltip="Test Newsletter"></span>
                        <span title="" data-tooltip-pos="bottom" class="gjs-pn-btn fa fa-save" id="saveStripoChanges2"
                              data-tooltip="Save Template"></span>
                        <span title="" data-tooltip-pos="bottom" class="gjs-pn-btn fa fa-question-circle"
                              data-tooltip="About"></span></div>


                </div>
                <div class="clearfix"></div>

                <div class="panel panel-flat mb30">
                    <div class="sms_preview">
                        <div class="phone_sms">
                            <div class="inner">
                                <p id="smsWorkflowCampaignPreview">
                                    {!! nl2br(base64_decode($compiledSource)) !!}
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <p><small>{{ date("h:i") . ' ' . dataFormat() }}</small></p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
<iframe src="" id="createTemplateThumbnail" width="100%" height="10" scrolling="no"
        style="border:none !important;overflow:hidden;visibility:hidden;"></iframe>


<script>

    function openFullscreen() {
        var elem = document.getElementById("gjs");
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
    }
</script>
<script>
    $(document).ready(function () {

        $(document).on("click", ".fa-question-circle", function () {
            window.parent.$("#smseditorinfo").modal("show");
        });

        $(document).on("click", ".sendTestSMS", function () {
            var campaignID = '{{ $campaignID }}'
            window.parent.$("#wf_test_sms_campaign_id").val(campaignID);
            window.parent.$("#wfSendTestSMS").modal('show');

        });

        $(document).on("click", "#wf_preview_edit_sms_template_send_sms_Edit", function () {
            var number = $("#wf_preview_edit_sms_template_text_number_Edit").val();
            var campaignId = $("#wf_sms_editor_campaign_id").val();
            var moduleName = $("#wf_sms_editor_moduleName").val();
            window.parent.$('.overlaynew').show();
            $.ajax({
                url: '/admin/workflow/sendTestSMSworkflowCampaign',
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'moduleName': moduleName, campaignId: campaignId, number: number},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.parent.displayMessagePopup("success", "Success", "Test SMS sent successfully!");
                        window.parent.$('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on("click", ".viewfullscreen", function () {
            openFullscreen();
        });

        $(document).on("click", "#backtoTree", function () {

            //$('#saveStripoChanges').trigger("click");
            window.parent.$("#superContainer").show();
            window.parent.$("#editTemplateContainer").hide();

        });


        $("#saveTemplate").click(function () {
            var souceCode = returnHtml();
            console.log(souceCode);
        });

        $(document).on("keyup", '#smsWorkflowCampaignBody', function () {
            var liveContent = $(this).val();
            liveContent = liveContent.replace(/\r\n|\r|\n/g, "<br />");

            if (liveContent == '') {
                $('#smsWorkflowCampaignPreview').hide();
            } else {
                $('#smsWorkflowCampaignPreview').show();
                $('#smsWorkflowCampaignPreview').html(liveContent);
            }
        });

        $(document).on('click', '#updateWorkflowSmsCampaign', function (e) {
            e.preventDefault();
            var templateContent = $("#smsWorkflowCampaignBody").val();
            var campaignId = $("#wf_sms_editor_campaign_id").val();
            var moduleName = $('#wf_sms_editor_moduleName').val();
            window.parent.$('.overlaynew').show();
            $.ajax({
                url: '/admin/workflow/updateWorkflowCampaign',
                type: "POST",
                data: {
                    _token: '{{csrf_token()}}',
                    stripo_compiled_html: templateContent,
                    campaignId: campaignId,
                    moduleName: moduleName
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.parent.$('.overlaynew').hide();
                        window.parent.displayMessagePopup("success", "Success", "SMS saved successfully!");
                        //window.location.href = window.location.href;
                        //alert('Action was Successful!');
                    }
                }
            });
            return false;
        });
    });
</script>

<script>
    $(document).ready(function () {

        $(document).on("click", "#wfOpenSMSTestCtrEdit", function () {
            $("#wfSMSActiveCtrEdit").hide();
            $("#wfSMSTestCtrEdit").show();
        });

        $(document).on("click", "#wfCloseSMSTestCtrEdit", function () {
            $("#wfSMSActiveCtrEdit").show();
            $("#wfSMSTestCtrEdit").hide();
        });

        $(document).on("click", "#saveStripoChanges,#saveStripoChanges2", function () {
            $('#updateWorkflowSmsCampaign').trigger("click");
        });

        $(document).on("click", "#saveToMyTemplates", function () {
            var moduleName = '{{ $moduleName }}';
            var campaignId = '{{ $campaignID }}';
            var template_source = '{{ $template_source }}';
            var compliledHtml = $("#smsWorkflowCampaignBody").val();
            window.parent.$('.overlaynew').show();
            $.ajax({
                url: '/admin/workflow/savetoMyTemplates',
                type: "POST",
                data: {
                    _token: '{{csrf_token()}}',
                    moduleName: moduleName,
                    stripo_compiled_html: compliledHtml,
                    campaignId: campaignId,
                    template_source: template_source
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.parent.$('.overlaynew').hide();
                        window.parent.displayMessagePopup("success", "Success", "Saved into your templates successfully");
                        var thumbSrc = '{{ base_url() }}admin/templates/saveThumbnail/' + data.mytemplateid;
                        $("#createTemplateThumbnail").attr("src", thumbSrc);

                    }
                }
            });
        });
        $(document).on("keypress", "#templateName", function () {
            $("#templateNameErrorMsg").hide();
        });
    });
</script>

</body>
</html>
