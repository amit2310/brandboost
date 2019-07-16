<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Stripo Plugin Example</title>
        <style>
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
                height: 30px;
                padding: 4px 13px 5px !important;
                font-weight: 600;
                color: #fff;
                line-height: 18px;
                margin-right: 5px;
                /*font-family: 'Inter UI'!important;*/
                box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05)!important;
            }
            #codeEditor{ float:left!important}
            #saveStripoChanges{float: right;margin: 0;}
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
        </style>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="http://brandboost.io/assets/js/core/libraries/jquery.min.js"></script>


    </head>
    <body>
        <div class="overlaynew" style="position: fixed;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.4); z-index: 99999;text-align: center; display:none;">
            <div style="top: 47%;position:relative;">
                <a class="bg-teal-400" id="spinner-dark-6">
                    <div class="ball-scale-multiple">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div><br> PROCESSING</a>
            </div>
        </div>
        <div id="externalSystemContainer">
            <!--This is external system container where you can place plugin buttons -->
            <button id="undoButton" class="control-button">Undo</button>
            <button id="redoButton" class="control-button">Redo</button>
            <button id="codeEditor" class="control-button">Code editor</button>
            <button id="saveStripoChanges" class="control-button">Save Email</button>
            <?php if ($moduleName == 'automation' || $moduleName == 'broadcast'): ?>
                <button id="saveStripoDraft" class="control-button">Save to my templates</button>
                <input type="hidden" id="draft_id" name="draft_id" value="<?php echo $draftID; ?>" />
            <?php endif; ?>

            <span id="changeHistoryContainer" style="display: none;">Last change: <a id="changeHistoryLink"></a></span>
        </div>
        <div class="notification-zone"></div>
        <div class="form-group">
            <label>Subject: </label>
            <input class="form-control" id="wf_campaign_subject" name="wf_campaign_subject"  placeholder="Email Subject" type="text" value="<?php echo $subject; ?>">
        </div>
        <div>
            <!--Plugin containers -->
            <div id="stripoSettingsContainer"></div>
            <div id="stripoPreviewContainer">
                <div class="loader-c app-loader">
                    <div class="loader-z"></div>
                </div>
            </div>
            

        </div>

        <div id="nameyourtemplate" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" name="updateDraftTemplateName" id="updateDraftTemplateName" action="javascript:void();">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> &nbsp;Name your template <i class="icon-info22 fsize12 txt_grey"></i></h5>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Please Enter Title For the Template:</label>
                                        <input class="form-control" id="templateName" name="templateName" placeholder="Enter Title for the Template" type="text" required>
                                        <label style="color:#ff0000;font-size:12px;display:none;" id="templateNameErrorMsg">This template name already exists</label>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="" name="template_draft_id" id="template_draft_id">
                            <input type="hidden" value="<?php echo $moduleName; ?>" name="moduleName">
                            <button type="submit" class="control-button">Save</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="application/javascript" src="<?php echo base_url(); ?>assets/js/notifications.js"></script>
        <script>
            // Utility methods
            function request(method, url, data, callback) {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function () {
            if (req.readyState === 4 && req.status === 200) {
            callback(req.responseText);
            } else if (req.readyState === 4 && req.status !== 200) {
            console.error('Can not complete request. Please check you entered a valid PLUGIN_ID and SECRET_KEY values');
            }
            };
            req.open(method, url, true);
            if (method !== 'GET') {
            req.setRequestHeader('content-type', 'application/json');
            }
            req.send(data);
            }

            function loadDemoTemplate(callback) {
            //callback({html: <?php echo $html; ?>, css: <?php echo $css; ?>});
            request('GET', '<?php echo base_url(); ?>/admin/workflow/loadStripoCampaignResources/html/<?php echo $moduleName; ?>/<?php echo $campaignID; ?>', null, function (html) {
                request('GET', '<?php echo base_url(); ?>/admin/workflow/loadStripoCampaignResources/css/<?php echo $moduleName; ?>/<?php echo $campaignID; ?>', null, function (css) {
                    callback({html: html, css: css});
                    });
                    });
                    }
        </script>

        <script>
            // Call this function to start plugin.
            // For security reasons it is STRONGLY recommended NOT to store your PLUGIN_ID and SECRET_KEY on client side.
            // Please use backend middleware to authenticate plugin.
            // See documentation: https://docs.google.com/document/d/1sSTdwV5Qa8oPY0X6coqK9MSQDfDHQxbWsgWFnHNYTwU/edit?usp=sharing
            function initPlugin(template) {
            const apiRequestData = {
            emailId: 123
            };
            const script = document.createElement('script');
            script.id = 'stripoScript';
            script.type = 'text/javascript';
            script.src = 'https://stripo.email/static/latest/stripo.js';
            script.onload = function () {
            window.Stripo.init({
            settingsId: 'stripoSettingsContainer',
                    previewId: 'stripoPreviewContainer',
                    codeEditorButtonId: 'codeEditor',
                    undoButtonId: 'undoButton',
                    redoButtonId: 'redoButton',
                    locale: 'en',
                    html: template.html,
                    css: template.css,
                    notifications: {
                    info: notifications.info.bind(notifications),
                            error: notifications.error.bind(notifications),
                            warn: notifications.warn.bind(notifications),
                            loader: notifications.loader.bind(notifications),
                            hide: notifications.hide.bind(notifications),
                            success: notifications.success.bind(notifications)
                    },
                    apiRequestData: apiRequestData,
                    userFullName: 'Plugin Demo User',
                    mergeTags: [
                    {
                    category: 'Brandboost',
                            entries: [
<?php if (!empty($tags)): ?>
    <?php foreach ($tags as $tag): ?>
                                    {label: '<?php echo ucwords(strtolower(str_replace(array('{', '}', '_'), array('', '', ' '), $tag))); ?>', value: '<?php echo $tag; ?>'},
    <?php endforeach; ?>
<?php endif; ?>

                            ]
                    }
                    ],
                    versionHistory: {
                    changeHistoryLinkId: 'changeHistoryLink',
                            onInitialized: function (lastChangeIndoText) {
                            $('#changeHistoryContainer').show();
                            }
                    }
            ,
                    getAuthToken: function (callback) {
                    request('POST', 'https://plugins.stripo.email/api/v1/auth',
                            JSON.stringify({
                            pluginId: '<?php echo $this->config->item("stripo_plugin_id"); ?>',
                                    secretKey: '<?php echo $this->config->item("stripo_secret_key"); ?>'
                            }),
                            function (data) {
                            callback(JSON.parse(data).token);
                            });
                    }
            }
            );
            };
            document.body.appendChild(script);
            }

            loadDemoTemplate(initPlugin);
            // initPlugin();


        </script>
        <script>
            $(document).ready(function () {

            $(document).on("click", "#saveStripoChanges", function () {
            window.StripoApi.getTemplate(function (html, css) {
            window.StripoApi.compileEmail(function (error, compliledHtml) {
            var moduleName = '<?php echo $moduleName; ?>';
            var subject = $("#wf_campaign_subject").val();
            var campaignId = '<?php echo $campaignID; ?>';
            var moduleUnitID = '<?php echo $moduleUnitID; ?>';
            $.ajax({
            url: '/admin/workflow/updateWorkflowCampaign',
                    type: "POST",
                    data: {moduleName: moduleName, subject: subject, stripo_html: html, stripo_css:css, stripo_compiled_html:compliledHtml, campaignId: campaignId, moduleUnitID:moduleUnitID},
                    dataType: "json",
                    success: function (data) {
                    if (data.status == 'success') {
                    //alert('Saved changes!');
                    } else {
                    alertMessage('Error: Some thing wrong!');
                    }
                    }
            });
            });
            });
            });
            $(document).on("click", "#saveStripoDraft", function () {
            window.StripoApi.getTemplate(function (html, css) {
            window.StripoApi.compileEmail(function (error, compliledHtml) {
            var moduleName = '<?php echo $moduleName; ?>';
            var subject = $("#wf_campaign_subject").val();
            var campaignId = '<?php echo $campaignID; ?>';
            var template_source = '<?php echo $template_source; ?>';
            var draftID = $("#draft_id").val();
            $.ajax({
            url: '/admin/workflow/saveWorkflowDraft',
                    type: "POST",
                    data: {moduleName: moduleName, subject: subject, stripo_html: html, stripo_css:css, stripo_compiled_html:compliledHtml, campaignId: campaignId, template_source: template_source, draftID:draftID},
                    dataType: "json",
                    success: function (data) {
                    if (data.status == 'success') {
                    var savedDraftID = $("#draft_id").val();
                    if (savedDraftID == '' || savedDraftID == null || savedDraftID == 'undefined'){
                    $("#template_draft_id").val(data.draftID);
                    $("#draft_id").val(data.draftID);
                    $("#nameyourtemplate").modal('show');
                    $(".modal-backdrop.in").hide();
                    } else{
                    $("#draft_id").val(data.draftID);
                    alert('Saved changes successfully');
                    }

                    } else {
                    alertMessage('Error: Some thing wrong!');
                    }
                    }
            });
            });
            });
            });
            $(document).on("submit", "#updateDraftTemplateName", function () {
            var formData = new FormData($(this)[0]);
            $.ajax({
            url: '<?php echo base_url('admin/workflow/updateWorkflowDraft'); ?>',
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                    if (data.status == 'success') {
                    $('.overlaynew').hide();
                    alert('Saved changes successfully');
                    $("#nameyourtemplate").modal('hide');
                    } else if (data.status == 'error' && data.msg == 'duplicate'){
                    $("#templateNameErrorMsg").show();
                    return false;
                    } else {
                    $('.overlaynew').hide();
                    alert('Error: Some thing wrong!');
                    }
                    }

            });
            });
            $(document).on("keypress", "#templateName", function(){
            $("#templateNameErrorMsg").hide();
            });
            });
        </script>
    </body>
</html>