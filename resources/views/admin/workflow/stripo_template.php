<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Stripo Plugin Example</title>
        <style>
            #externalSystemContainer {
                background-color: darkgrey;
                padding: 5px 0 5px 20px;
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
                border-radius: 17px;
                padding: 5px 10px;
                border-color: grey;
            }
            #changeHistoryLink {
                cursor: pointer;
            }
        </style>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/core/libraries/jquery.min.js"></script>


    </head>
    <body>
        <div id="externalSystemContainer">
            <!--This is external system container where you can place plugin buttons -->
            <button id="undoButton" class="control-button">Undo</button>
            <button id="redoButton" class="control-button">Redo</button>
            <button id="codeEditor" class="control-button">Code editor</button>
            <button id="saveStripoChanges" class="control-button">Save Changes</button>
            <?php if($moduleName == 'automation' || $moduleName == 'broadcast'):?>
            <button id="saveStripoDraft" class="control-button">Save Draft</button>
            <input type="hidden" id="draft_id" name="draft_id" />
            <?php endif; ?>
            <span id="changeHistoryContainer" style="display: none;">Last change: <a id="changeHistoryLink"></a></span>
        </div>
        <div class="notification-zone"></div>
        <div class="form-group">
            <label>Subject: </label>
            <input class="form-control" id="wf_template_subject" name="wf_template_subject"  placeholder="Email Subject" type="text" value="<?php echo $subject; ?>" style="width:100%">
        </div>
        <?php if($moduleName != 'automation'):?>
        <div class="form-group">
            <label>Greetings: </label>
            <input type="text" required="required" name="greeting" id="wfEmailTemplateGreetings"class="form-control" placeholder="Greetings" value="<?php echo $greeting; ?>" style="width:100%" />
        </div>

        <div class="form-group">
            <label>Introduction: </label>
            <textarea style="height: 100px;" name="introduction" id="wfEmailTemplateIntroduction" class="form-control" placeholder="Introduction" style="width:100%"><?php echo $introduction; ?></textarea>
        </div>
        <?php endif;?>
        <?php if($moduleName == 'automation'):?>
        <div>
            <!--Plugin containers -->
            <div id="stripoSettingsContainer">Loading...</div>
            <div id="stripoPreviewContainer"></div>
        </div>
        <?php endif; ?>

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

            request('GET', '<?php echo base_url(); ?>admin/workflow/loadStripoTemplateResources/html/<?php echo $moduleName; ?>/<?php echo $templateID; ?>', null, function (html) {
                request('GET', '<?php echo base_url(); ?>admin/workflow/loadStripoTemplateResources/css/<?php echo $moduleName; ?>/<?php echo $templateID; ?>', null, function (css) {
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
                            pluginId: '<?php echo config('bbconfig.stripo_plugin_id'); ?>',
                                    secretKey: '<?php echo config('bbconfig.stripo_secret_key'); ?>'
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
            var subject = $("#wf_template_subject").val();
            var templateId = '<?php echo $templateID; ?>';
            var greeting = $('#wfEmailTemplateGreetings').val();
            var introduction = $('#wfEmailTemplateIntroduction').val();
            $.ajax({
            url: '/admin/workflow/updateWorkflowTemplate',
                    type: "POST",
                    data: {moduleName: moduleName, subject: subject, stripo_html: html, stripo_css:css, stripo_compiled_html:compliledHtml, templateId: templateId, greeting: greeting, introduction: introduction},
                    dataType: "json",
                    success: function (data) {
                    if (data.status == 'success') {
                    alert('Saved changes!');
                    } else {
                    alert('Error: Some thing wrong!');
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
            var campaignId = '<?php if(!empty($campaignID)) { echo $campaignID; } else { echo '';} ?>';
            var template_source = '<?php if(!empty($template_source)) { echo $template_source; } else { echo '';} ?>';
            var draftID = $("#draft_id").val();
                    $.ajax({
                    url: '/admin/workflow/saveWorkflowDraft',
                            type: "POST",
                            data: {moduleName: moduleName, subject: subject, stripo_html: html, stripo_css:css, stripo_compiled_html:compliledHtml, campaignId: campaignId, template_source: template_source, draftID:draftID},
                            dataType: "json",
                            success: function (data) {
                            if (data.status == 'success') {
                            $("#draft_id").val(data.draftID);    
                            alert('Saved changes!');
                            } else {
                            alertMessage('Error: Some thing wrong!');
                            }
                            }
                    });
            });
            });
            });
            
            
            });
        </script>
    </body>
</html>