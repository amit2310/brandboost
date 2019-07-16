<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Email Editor</title>
        <link rel="stylesheet" href="//unpkg.com/grapesjs@0.10.7/dist/css/grapes.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>grapes/style/material.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>grapes/style/tooltip.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>grapes/style/toastr.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>grapes/dist/grapesjs-preset-newsletter.css">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">


        <script>
            var num = Date.now();
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/bootstrap.min.js?t=num"></script>
        <script src="//unpkg.com/grapesjs@0.10.7/dist/grapes.min.js"></script>
        <script src="<?php echo base_url(); ?>grapes/dist/grapesjs-preset-newsletter.min.js"></script>
        <link href="<?php echo base_url(); ?>new_pages/assets/css/theme1.css" rel="stylesheet" type="text/css">

<!--        <script src="<?php echo base_url(); ?>grapes/js/toastr.min.js"></script>

<script src="<?php echo base_url(); ?>grapes/private/ajaxable.min.js"></script>-->
    </head>
    <style>
        body, html{ height: 100%; margin: 0;}
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
        .grapesjs-logo path{
            stroke: #eee !important;
            stroke-width: 8 !important;
        }

        #toast-container {
            font-size: 13px;
            font-weight: lighter;
        }
        #toast-container > div,
        #toast-container > div:hover{
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
            font-family: Helvetica, sans-serif;
        }
        #toast-container > div{
            opacity: 0.95;
        }
        #externalSystemContainer {
            background-color: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
            text-align:right;
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
            height: 40px;
            padding: 4px 13px 5px !important;
            font-weight: 600;
            color: #fff;
            line-height: 18px;
            margin-right: 5px;
            margin-bottom: 15px;
            /*font-family: 'Inter UI'!important;*/
            box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05)!important;
        }

        .control-button-red {
            display: inline-block;
            border-radius: 5px;
            font-size: 13px !important;
            background-color: #eb4f76 !important;
            border: none;
            height: 40px;
            padding: 4px 13px 5px !important;
            font-weight: 600;
            color: #fff;
            line-height: 18px;
            margin-right: 5px;
            margin-bottom: 15px;
            /*font-family: 'Inter UI'!important;*/
            box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05)!important;
        }
        .control-button:hover{background:#2f3053!important;}


        #codeEditor{ float:left!important}
        #saveStripoChanges, #saveStripoDraft{float: right;margin-left: 10px;margin-top:10px;}
        .control-button:hover{ background:#237ec0}
        #changeHistoryLink {
            cursor: pointer;
        }
        .form-group{ padding:0 20px!important; margin-bottom:20px;}
        .form-control{ border-radius:5px!important; border:1px solid #ddd!important;}
        .app-loader {
            display: flex;
            align-items: center;
            height: 100% !important;
            margin-top: -65px;
            margin-left:50%;
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
        .white_box {
            width: 100%;
            padding: 20px;
            border-radius: 5px;
            background-color: #ffffff;
            position: relative;
            margin-bottom: 10px;
            box-shadow: 0 3px 5px 0 rgba(1, 21, 64, 0.06);
        }

    </style>
    <body>
        <button type="button" id="saveEditorChanges" style="display:none;">Save Changes</button>
        <div id="gjs" style="height:0px; overflow:hidden">

            <?php echo base64_decode($compiledSource); ?>



            <style>
                .link {
                    color: rgb(217, 131, 166);
                }
                .row{
                    vertical-align:top;
                }
                .main-body{
                    min-height:150px;
                    padding: 5px;
                    width:100%;
                    height:100%;
                    background-color:rgb(234, 236, 237);
                }
                .c926{
                    color:rgb(158, 83, 129);
                    width:100%;
                    font-size:50px;
                }
                .cell.c849{
                    width:11%;
                }
                .c1144{
                    padding: 10px;
                    font-size:17px;
                    font-weight: 300;
                }
                .card{
                    min-height:150px;
                    padding: 5px;
                    margin-bottom:20px;
                    height:0px;
                }
                .card-cell{
                    background-color:rgb(255, 255, 255);
                    overflow:hidden;
                    border-radius: 3px;
                    padding: 0;
                    text-align:center;
                }
                .card.sector{
                    background-color:rgb(255, 255, 255);
                    border-radius: 3px;
                    border-collapse:separate;
                }
                .c1271{
                    width:100%;
                    margin: 0 0 15px 0;
                    font-size:50px;
                    color:rgb(120, 197, 214);
                    line-height:250px;
                    text-align:center;
                }
                .table100{
                    width:100%;
                }
                .c1357{
                    min-height:150px;
                    padding: 5px;
                    margin: auto;
                    height:0px;
                }
                .darkerfont{
                    color:rgb(65, 69, 72);
                }
                .button{
                    font-size:12px;
                    padding: 10px 20px;
                    background-color:rgb(217, 131, 166);
                    color:rgb(255, 255, 255);
                    text-align:center;
                    border-radius: 3px;
                    font-weight:300;
                }
                .table100.c1437{
                    text-align:left;
                }
                .cell.cell-bottom{
                    text-align:center;
                    height:51px;
                }
                .card-title{
                    font-size:25px;
                    font-weight:300;
                    color:rgb(68, 68, 68);
                }
                .card-content{
                    font-size:13px;
                    line-height:20px;
                    color:rgb(111, 119, 125);
                    padding: 10px 20px 0 20px;
                    vertical-align:top;
                }
                .container{
                    font-family: Helvetica, serif;
                    min-height:150px;
                    padding: 5px;
                    margin:auto;
                    height:0px;
                    width:90%;
                    max-width:550px;
                }
                .cell.c856{
                    vertical-align:middle;
                }
                .container-cell{
                    vertical-align:top;
                    font-size:medium;
                    padding-bottom:50px;
                }
                .c1790{
                    min-height:150px;
                    padding: 5px;
                    margin:auto;
                    height:0px;
                }
                .table100.c1790{
                    min-height:30px;
                    border-collapse:separate;
                    margin: 0 0 10px 0;
                }
                .browser-link{
                    font-size:12px;
                }
                .top-cell{
                    text-align:right;
                    color:rgb(152, 156, 165);
                }
                .table100.c1357{
                    margin: 0;
                    border-collapse:collapse;
                }
                .c1769{
                    width:30%;
                }
                .c1776{
                    width:70%;
                }
                .c1766{
                    margin: 0 auto 10px 0;
                    padding: 5px;
                    width:100%;
                    min-height:30px;
                }
                .cell.c1769{
                    width:11%;
                }
                .cell.c1776{
                    vertical-align:middle;
                }
                .c1542{
                    margin: 0 auto 10px auto;
                    padding:5px;
                    width:100%;
                }
                .card-footer{
                    padding: 20px 0;
                    text-align:center;
                }
                .c2280{
                    height:150px;
                    margin:0 auto 10px auto;
                    padding:5px 5px 5px 5px;
                    width:100%;
                }
                .c2421{
                    padding:10px;
                }
                .c2577{
                    padding:10px;
                }
                .footer{
                    margin-top: 50px;
                    color:rgb(152, 156, 165);
                    text-align:center;
                    font-size:11px;
                    padding: 5px;
                }
                .quote {
                    font-style: italic;
                }

                .list-item{
                    height:auto;
                    width:100%;
                    margin: 0 auto 10px auto;
                    padding: 5px;
                }
                .list-item-cell{
                    background-color:rgb(255, 255, 255);
                    border-radius: 3px;
                    overflow: hidden;
                    padding: 0;
                }
                .list-cell-left{
                    width:30%;
                    padding: 0;
                }
                .list-cell-right{
                    width:70%;
                    color:rgb(111, 119, 125);
                    font-size:13px;
                    line-height:20px;
                    padding: 10px 20px 0px 20px;
                }
                .list-item-content{
                    border-collapse: collapse;
                    margin: 0 auto;
                    padding: 5px;
                    height:150px;
                    width:100%;
                }
                .list-item-image{
                    color:rgb(217, 131, 166);
                    font-size:45px;
                    width: 100%;
                }

                .grid-item-image{
                    line-height:150px;
                    font-size:50px;
                    color:rgb(120, 197, 214);
                    margin-bottom:15px;
                    width:100%;
                }
                .grid-item-row {
                    margin: 0 auto 10px;
                    padding: 5px 0;
                    width: 100%;
                }
                .grid-item-card {
                    width:100%;
                    padding: 5px 0;
                    margin-bottom: 10px;
                }
                .grid-item-card-cell{
                    background-color:rgb(255, 255, 255);
                    overflow: hidden;
                    border-radius: 3px;
                    text-align:center;
                    padding: 0;
                }
                .grid-item-card-content{
                    font-size:13px;
                    color:rgb(111, 119, 125);
                    padding: 0 10px 20px 10px;
                    width:100%;
                    line-height:20px;
                }
                .grid-item-cell2-l{
                    vertical-align:top;
                    padding-right:10px;
                    width:50%;
                }
                .grid-item-cell2-r{
                    vertical-align:top;
                    padding-left:10px;
                    width:50%;
                }
            </style>


        </div>



        <form id="test-form" class="test-form" method="POST" style="display:none">
            <div class="gjs-sm-property">
                <div class="gjs-field">
                    <span id="gjs-sm-input-holder">
                        <input type="email" name="email" id="wfPreviewTestCtr_text_email" placeholder="Email" required style="color:#000000;">
                    </span>
                </div>
            </div>

            <input type="hidden" name="body">


            <button type="button" class="gjs-btn-prim gjs-btn-import" id="wfPreviewTestCtr_send_email" style="width: 100%">SEND</button>
        </form>


        <div id="info-cont" style="display:none">
            <div class="gjs-import-label">
                <b>Brandboost Email Builder</b> We will revert back to you very soon with detailed document and help videos
            </div>
        </div>

        <div id="success_notice" class="hide">
            <div class="flag_notifications">
                <a style="cursor: pointer;" class="fn_close" name="cancel"><i class="icon-cross2 txt_green"></i></a>
                <div class="row">
                    <div class="col-xs-2"><img width="40" src="<?php echo base_url(); ?>assets/images/notification_green.png"/></div>
                    <div class="col-xs-10">
                        <p class="notification_success_msg_heading" style="font-weight:600;">Success!</p>
                        <p class="mb-15 notification_success_msg_des">Your data have been updated successfully!</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="error_notice" class="hide">
            <div class="flag_notifications">
                <a style="cursor: pointer;" class="fn_close" name="cancel"><i class="icon-cross2 txt_red"></i></a>
                <div class="row">
                    <div class="col-xs-2"><img width="40" src="<?php echo base_url(); ?>assets/images/notification_red.png"/></div>
                    <div class="col-xs-10">
                        <p class="notification_success_msg_heading" style="font-weight:600;">OOPS!</p>
                        <p class="mb-15 notification_success_msg_des">Your changes has been not updated. Please try again!</p>
                    </div>
                </div>
            </div>
        </div>
        <iframe src="" id="createTemplateThumbnail" width="100%" height="10" scrolling="no" style="border:none !important;overflow:hidden;visibility:hidden;"></iframe>



        <script>
            $(document).ready(function () {
                $(document).on("click", ".fa-question-circle", function () {
                    window.parent.$("#emaileditorinfo").modal("show");
                });

                $(document).on("click", ".fa-paper-plane", function () {
                    var campaignId = '<?php echo $campaignID; ?>';
                    window.parent.$("#wf_test_email_campaign_id").val(campaignId);
                    window.parent.$("#wfSendTestEmail").modal('show');
                });

                $(document).on("click", "#saveEditorChanges", function () {
                    var templateId = '<?php echo $templateID; ?>';
                    var compliledHtml = returnHtml();
                    window.parent.$('.overlaynew').show();
                    $.ajax({
                        url: '/admin/templates/updateUserTemplate',
                        type: "POST",
                        data: {compiled_html: compliledHtml, templateId: templateId},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'success') {
                                //alert('Saved changes successfully');
                                var thumbSrc = '<?php echo base_url();?>admin/templates/saveThumbnail/<?php echo $templateID; ?>';
                                $("#createTemplateThumbnail").attr("src", thumbSrc);
                                setTimeout(function () {
                                    window.parent.$('.overlaynew').hide();
                                    window.parent.displayMessagePopup("success", "Success", "template updated successfully!");
                                }, 500);

                            } else {
                                window.parent.displayMessagePopup("error", "Error", "something went wrong!");
                            }
                        }
                    });
                });
                $(document).on("click", "#saveStripoDraft", function () {
                    var moduleName = '<?php echo $moduleName; ?>';
                    var subject = $("#wf_campaign_subject").val();
                    var campaignId = '<?php echo $campaignID; ?>';
                    var template_source = '<?php echo $template_source; ?>';
                    var draftID = $("#draft_id").val();
                    var compliledHtml = returnHtml();
                    window.parent.$('.overlaynew').show();
                    $.ajax({
                        url: '/admin/workflow/saveWorkflowDraft',
                        type: "POST",
                        data: {moduleName: moduleName, subject: subject, stripo_compiled_html: compliledHtml, campaignId: campaignId, template_source: template_source, draftID: draftID},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'success') {
                                window.parent.$('.overlaynew').hide();
                                var savedDraftID = $("#draft_id").val();
                                if (savedDraftID == '' || savedDraftID == null || savedDraftID == 'undefined') {
                                    window.parent.$("#template_draft_id").val(data.draftID);
                                    $("#draft_id").val(data.draftID);
                                    //window.parent.displayMessagePopup("success", "Success", "Saved successfully!");
                                    window.parent.$("#nameyourtemplate").modal('show');
                                    //$(".modal-backdrop.in").hide();
                                } else {
                                    $("#draft_id").val(data.draftID);
                                    window.parent.displayMessagePopup("success", "Success", "Draft saved successfully");
                                    window.parent.$('.overlaynew').hide();
                                    //alert('Saved changes successfully');
                                }

                            } else {
                                alertMessage('Error: Some thing wrong!');
                            }
                        }
                    });
                });

                $(document).on("keypress", "#templateName", function () {
                    $("#templateNameErrorMsg").hide();
                });
            });
        </script>
        <script type="text/javascript">
            var host = '<?php echo base_url(); ?>';
            /*var images = [
             host + 'img/grapesjs-logo.png',
             host + 'img/tmp-blocks.jpg',
             host + 'img/tmp-tgl-images.jpg',
             host + 'img/tmp-send-test.jpg',
             host + 'img/tmp-devices.jpg',
             ];*/

            // Set up GrapesJS editor with the Newsletter plugin
            var editor = grapesjs.init({
                height: '100%',
                //noticeOnUnload: 0,
                storageManager: {
                    autoload: 0,
                },
                assetManager: {
                    assets: {},
                    upload: '<?php echo base_url(); ?>uploads',
                    uploadText: 'Drop files here or click to upload',
                    uploadFile: function (e) {
                        window.parent.$('.overlaynew').show();
                        var files = e.dataTransfer ? e.dataTransfer.files : e.target.files;
                        var formData = new FormData();
                        for (var i in files) {
                            formData.append('files', files[i]) //containing all the selected images from local
                        }
                        $.ajax({
                            url: '<?php echo base_url(); ?>dropzone/upload_editor_image',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            crossDomain: true,
                            dataType: 'json',
                            mimeType: "multipart/form-data",
                            processData: false,
                            success: function (result) {
                                window.parent.$('.overlaynew').hide();
                                editor.AssetManager.add(result['data']);


                            }
                        });
                    },
                },
                container: '#gjs',
                fromElement: true,
                plugins: ['gjs-preset-newsletter'],
                pluginsOpts: {
                    'gjs-preset-newsletter': {
                        modalLabelImport: 'Paste all your code here below and click import',
                        modalLabelExport: 'Copy the code and use it wherever you want',
                        codeViewerTheme: 'material',
                        //defaultTemplate: templateImport,
                        importPlaceholder: '<table class="table"><tr><td class="cell">Hello world!</td></tr></table>',
                        cellStyle: {
                            'font-size': '12px',
                            'font-weight': 300,
                            'vertical-align': 'top',
                            color: 'rgb(111, 119, 125)',
                            margin: 0,
                            padding: 0,
                        }
                    }
                }
            });
            function returnHtml() {
                var cmdm = editor.Commands;
                var cmdGetCode = cmdm.get('gjs-get-inlined-html');
                var source = cmdGetCode && cmdGetCode.run(editor);
                return source;
            }


            // Let's add in this demo the possibility to test our newsletters
            var mdlClass = 'gjs-mdl-dialog-sm';
            var pnm = editor.Panels;
            var cmdm = editor.Commands;
            var testContainer = document.getElementById("test-form");
            var contentEl = testContainer.querySelector('input[name=body]');
            var md = editor.Modal;
            /*cmdm.add('send-test', {
             run(editor, sender) {
             sender.set('active', 0);
             var modalContent = md.getContentEl();
             var mdlDialog = document.querySelector('.gjs-mdl-dialog');
             var cmdGetCode = cmdm.get('gjs-get-inlined-html');
             contentEl.value = cmdGetCode && cmdGetCode.run(editor);
             mdlDialog.className += ' ' + mdlClass;
             testContainer.style.display = 'block';
             md.setTitle('Test your Newsletter');
             md.setContent('');
             md.setContent(testContainer);
             md.open();
             md.getModel().once('change:open', function () {
             mdlDialog.className = mdlDialog.className.replace(mdlClass, '');
             //clean status
             })
             }
             });*/
            cmdm.add('save-template', {
                run(editor, sender) {
                    $("#saveEditorChanges").trigger("click");
                    var cmdGetCode = cmdm.get('gjs-get-inlined-html');
                    var source = cmdGetCode && cmdGetCode.run(editor);
                    //console.log(source);
                }
            });
            pnm.addButton('options', {
                id: 'send-test',
                className: 'fa fa-paper-plane',
                command: 'send-test',
                attributes: {
                    'title': 'Test Newsletter',
                    'data-tooltip-pos': 'bottom',
                },
            });
            pnm.addButton('options', {
                id: 'save-template',
                className: 'fa fa-save',
                command: 'save-template',
                attributes: {
                    'title': 'Save Template',
                    'data-tooltip-pos': 'bottom',
                },
            });
            //fa fa-refresh
            var statusFormElC = document.querySelector('.form-status');
            var statusFormEl = document.querySelector('.form-status i');
//            var ajaxTest = ajaxable(testContainer).
//                    onStart(function () {
//                        statusFormEl.className = 'fa fa-refresh anim-spin';
//                        statusFormElC.style.opacity = '1';
//                        statusFormElC.className = 'form-status';
//                    })
//                    .onResponse(function (res) {
//                        if (res.data) {
//                            statusFormElC.style.opacity = '0';
//                            statusFormEl.removeAttribute('data-tooltip');
//                            md.close();
//                        } else if (res.errors) {
//                            statusFormEl.className = 'fa fa-exclamation-circle';
//                            statusFormEl.setAttribute('data-tooltip', res.errors);
//                            statusFormElC.className = 'form-status text-danger';
//                        }
//                    });

            // Add info command
            /*var infoContainer = document.getElementById("info-cont");
             cmdm.add('open-info', {
             run(editor, sender) {
             sender.set('active', 0);
             var mdlDialog = document.querySelector('.gjs-mdl-dialog');
             mdlDialog.className += ' ' + mdlClass;
             infoContainer.style.display = 'block';
             md.setTitle('How to use this editor');
             md.setContent('');
             md.setContent(infoContainer);
             md.open();
             md.getModel().once('change:open', function () {
             mdlDialog.className = mdlDialog.className.replace(mdlClass, '');
             })
             }
             });*/
            pnm.addButton('options', {
                id: 'view-info',
                className: 'fa fa-question-circle',
                command: 'open-info',
                attributes: {
                    'title': 'About',
                    'data-tooltip-pos': 'bottom',
                },
            });
            // Simple warn notifier
            /*var origWarn = console.warn;
             toastr.options = {
             closeButton: true,
             preventDuplicates: true,
             showDuration: 250,
             hideDuration: 150
             };
             console.warn = function (msg) {
             toastr.warning(msg);
             origWarn(msg);
             };*/




            $(document).ready(function () {

                // Beautify tooltips
                $('*[title]').each(function () {
                    var el = $(this);
                    var title = el.attr('title').trim();
                    if (!title)
                        return;
                    el.attr('data-tooltip', el.attr('title'));
                    el.attr('title', '');
                });
            });
        </script>
    </body>
</html>
