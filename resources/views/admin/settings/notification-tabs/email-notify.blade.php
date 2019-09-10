<div class="tab-pane <?php if ($seletedTab == 'email'): ?>active<?php endif; ?>" id="right-icon-tab1">
    <div class="row">
        <div class="col-md-12">
            <div style="margin: 0;" class="panel panel-flat">
                <div class="panel-heading"> 
                    <span class="pull-left">
                        <h6 class="panel-title"><?php echo count($oTemplates); ?> Email Templates</h6>
                    </span>
                    <div class="heading_links pull-left">
                        <a class="top_links email_notification btn btn-xs btn_white_table ml20" type="all">All</a>
                        <a class="top_links email_notification" type="admin">Admin</a>
                        <a class="top_links email_notification" type="client" href="javascript:void(0);">Client</a> 
                        <a class="top_links email_notification" type="user" href="javascript:void(0);">User</a> 
                    </div>
                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                            <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body p0">
                    <table class="table datatable-basic datatable-sorting">
                        <thead>
                            <tr>
                                <th style="display:none;"></th>
                                <th style="display:none;"></th>
                                <th><i class="icon-user"></i> Title</th>
                                <th><i class="icon-user"></i> Event Name</th>
                                <th class="subAdmin"><i class="icon-iphone"></i>Admin Subject</th>
                                <th class="subClient"><i class="icon-iphone"></i>Client Subject</th>
                                <th class="subUser"><i class="icon-iphone"></i>User Subject</th>
                                <!-- <th width="300"><i class="icon-iphone"></i> Plain Text</th> -->
                                <!-- <th><i class="icon-iphone"></i> Html Text</th> -->
                                <!-- <th><i class="icon-iphone"></i> Email Type</th> -->
                                <th><i class="icon-calendar"></i> Created</th>
                                <th class="text-center"><i class="fa fa-dot-circle-o"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!--=======================-->
                            <?php foreach ($oEmailTemplates as $oTemplate) { ?>
                                <tr>
                                    <td style="display:none;"></td>
                                    <td style="display:none;"></td>
                                    <td>
                                        <?php echo $oTemplate->title; ?>
                                    </td>

                                    <td>
                                        <?php echo $oTemplate->template_tag; ?>
                                    </td>

                                     <td class="subAdmin emailNotiSmartPopup" type="admin" template_id="<?php echo $oTemplate->id; ?>" style="cursor: pointer;">
                                        <?php 
                                        if(!empty($oTemplate->subject_admin)) {
                                            echo setStringLimit($oTemplate->subject_admin);
                                        } 
                                        else {
                                            echo '<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>';
                                        }
                                        ?>
                                    </td>

                                    <td class="subClient emailNotiSmartPopup" type="client" template_id="<?php echo $oTemplate->id; ?>" style="cursor: pointer;">
                                        <?php 
                                        if(!empty($oTemplate->subject)) {
                                            echo setStringLimit($oTemplate->subject);
                                        } 
                                        else {
                                            echo '<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>';
                                        }
                                        ?>
                                    </td>

                                    <td class="subUser emailNotiSmartPopup" type="user" template_id="<?php echo $oTemplate->id; ?>" style="cursor: pointer;">
                                        <?php 
                                        if(!empty($oTemplate->subject_user)) {
                                            echo setStringLimit($oTemplate->subject_user);
                                        } 
                                        else {
                                            echo '<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>';
                                        }
                                        ?>
                                    </td>

                                   <!--  <td>
                                        <?php //echo base64_decode($oTemplate->plain_text); ?>
                                    </td> -->

                                   <!--  <td>
                                        <a class="editEmailNotificationTemplate" template_id="<?php echo $oTemplate->id; ?>">View</a>
                                    </td> -->

                                    <!-- <td>
                                        <?php echo ucfirst($oTemplate->content_type); ?>
                                    </td> -->

                                    <td>
                                        <div class="media-left">
                                            <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oTemplate->created)); ?></a></div>
                                            <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oTemplate->created)); ?></div>
                                        </div>

                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn green_cust_btn editEmailNotificationTemplate"  template_id="<?php echo $oTemplate->id; ?>"><i class="fa fa-eye"></i></a>
                                        <?php if ($oTemplate->write_permission == true): ?>
                                            <a class="btn red deleteEmailNotificationTemplate" template_id="<?php echo $oTemplate->id; ?>"><i class="fa fa-trash"></i></a>
                                        <?php else: ?>
                                            <a href="javascript:void(0)" title="Deleting this template not allowed" class="btn red"><i class="fa fa-trash" style="color:#ccc;"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addEmailNotificationTemplate" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddEmailTemplate" id="frmAddEmailTemplate" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Email Notification Template</h5>
                </div>

                <div class="modal-body">

                    <div class="">
                        <a class="top_links sub_notification_form btn btn-xs btn_white_table active" type="admin" href="javascript:void(0);">Admin</a>
                        <a class="top_links sub_notification_form btn btn-xs btn_white_table" type="client" href="javascript:void(0);">Client</a> 
                        <a class="top_links sub_notification_form btn btn-xs btn_white_table" type="user" href="javascript:void(0);">User</a> 
                    </div>

                    <p>Title:
                        <input class="form-control" name="title" placeholder="Enter Title for the notification" type="text" required></p>
                     <p>Event Name:
                        <input class="form-control" name="template_tag" placeholder="Enter Event Name" type="text" required></p>

                    <span class="subAdmin subAdminForm">
                        <p>Admin Subject:
                            <input class="form-control" id="addSubEmailsubAdmin" name="admin_subject" placeholder="Enter Subject" type="text" ></p>
                        <p>Admin Text:
                            <textarea class="form-control summernote" id="addSubEmailAdmin" name="admin_text" rows="6" placeholder="Enter Plain Text"></textarea></p>

                        <p>
                            <button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
                        </p>
                    </span>

                    <span class="subClient subClientForm" style="display: none;">
                        <p>Client Subject:
                            <input class="form-control" id="addSubEmailsubClient" name="subject" placeholder="Enter Subject" type="text" ></p>
                        
                        <p> Client Text:
                            <textarea class="form-control summernote" id="addSubEmailClient" name="plain_text" rows="6" placeholder="Enter Plain Text" ></textarea></p>
                        <p>
                            <button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
                        </p>
                    </span>

                    <span class="subUser subUserForm" style="display: none;">
                        <p>User Subject:
                            <input class="form-control" id="addSubEmailsubUser" name="user_subject" placeholder="Enter Subject" type="text" ></p>
                        <p>User Text:
                            <textarea class="form-control summernote" id="addSubEmailUser" name="user_text"  rows="6" placeholder="Enter Plain Text" ></textarea></p>

                        <p>
                            <button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
                        </p>
                    </span> 

                    <div class="showEmailMsg" style="color: green;"></div>
                    <p>Notification Preview:        
                            <input style="width: 88% !important;display: inline-block;margin-right: 15px;" class="form-control h40 input90" type="text" id="testEmailSub" name="testEmailSub" value="" placeholder="Enter test email">
                            <a class="btn dark_btn bkg_sblue2 h40 sendTestEmailPreviewSub" style="padding: 7px 13px !important;min-width: 40px !important;display: inline-block;line-height: 26px;background: #6190fa!important;"><i style="font-size: 15px!important;" class="icon-paperplane fsize15"></i></a>
                            <input type="hidden" name="emailTypeSub" class="emailTypeSub" id="emailTypeSub" value="admin">
                    </p>

                    <!-- <p>Email Type
                        <input type="radio" id="notify-plain-text" name="content_type" value="plain" style="margin-left:10px;" checked="checked" /> <label for="notify-plain-text">Plain</label>
                        <input type="radio" id="notify-html-text" name="content_type" value="html" style="margin-left:10px;"  /> <label for="notify-html-text">Html</label>

                    </p> 

                    <p>Send SMS Too
                        <label class="custom-form-switch">
                            <input type="checkbox" name="send_sms" id="sys_send_sms" class="field checkedBoxValue">
                            <span class="toggle"></span>
                        </label>
                    </p>  -->

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn dark_btn">Create</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editEmailNotificationTemplate" class="modal fade">
    <div style="max-width: 760px;" class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmEditSysEmailTemplate" id="frmEditSysEmailTemplate" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Edit System Notification Template</h5>
                </div>
                <div class="modal-body">

                    <div class="">
                        <a class="top_links sub_notification_form btn btn-xs btn_white_table active" type="admin" href="javascript:void(0);">Admin</a>
                        <a class="top_links sub_notification_form btn btn-xs btn_white_table" type="client" href="javascript:void(0);">Client</a> 
                        <a class="top_links sub_notification_form btn btn-xs btn_white_table" type="user" href="javascript:void(0);">User</a> 
                    </div>

                    <p>Title:
                        <input class="form-control" name="title" id="sys_email_template_title" placeholder="Enter Title for the notification" type="text" required></p>

                    <p>Event Name:
                        <input class="form-control" name="template_tag" id="sys_email_template_tag" placeholder="Enter Event Name" type="text" readonly="readonly" style="background:#ccc;"  required></p>
                    
                    <span class="subAdmin subAdminForm">
                        <p>Admin Subject:
                            <input class="form-control" name="admin_subject" id="sys_email_subject_admin" placeholder="Enter Subject" type="text" ></p>

                        <p>Admin Text:
                            <textarea class="form-control summernote" name="admin_text" rows="6" id="sys_email_admin_text" placeholder="Enter Plain Text"></textarea></p>

                        <p><button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;</p>
                    </span>

                    <span class="subClient subClientForm" style="display: none;">
                        <p>Client Subject:
                            <input class="form-control" name="subject" id="sys_email_subject" placeholder="Enter Subject" type="text" ></p>

                        <p>Client Text:
                            <textarea class="form-control summernote" name="plain_text" rows="6" id="sys_email_plain_text" placeholder="Enter Plain Text"></textarea></p>

                        <p><button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;</p>
                    </span>

                    <span class="subUser subUserForm" style="display: none;">
                        <p>User Subject:
                            <input class="form-control" name="user_subject" id="sys_email_subject_user" placeholder="Enter Subject" type="text"></p> 

                        <p>User Text:
                            <textarea class="form-control summernote" name="user_text" rows="6" id="sys_email_user_text" placeholder="Enter Plain Text"></textarea></p>

                        <p><button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;</p>
                    </span>

                    <div class="showEmailMsg" style="color: green;"></div>
                    <p>Notification Preview:        
                            <input style="width: 88% !important;display: inline-block;margin-right: 15px;" class="form-control h40 input90" type="text" id="testEmailSubEdit" name="testEmailSubEdit" value="" placeholder="Enter test email">
                            <a class="btn dark_btn bkg_sblue2 h40 sendTestEmailPreviewSubEdit" style="padding: 7px 13px !important;min-width: 40px !important;display: inline-block;line-height: 26px;background: #6190fa!important;"><i style="font-size: 15px!important;" class="icon-paperplane fsize15"></i></a>
                            <input type="hidden" name="emailTypeSubEdit" class="emailTypeSubEdit" id="emailTypeSubEdit" value="admin">
                    </p>

                    <!-- <p>Email Type
                        <input type="radio" id="edit-notify-plain-text" name="edit_content_type" value="plain" style="margin-left:10px;" checked="checked" /> <label for="edit-notify-plain-text">Plain</label>
                        <input type="radio" id="edit-notify-html-text" name="edit_content_type" value="html" style="margin-left:10px;"  /> <label for="edit-notify-html-text">Html</label>

                    </p>

                    <p>Send SMS Too
                        <label class="custom-form-switch">
                            <input type="checkbox" name="send_sms" id="edit_send_sms" class="field checkedBoxValue">
                            <span class="toggle"></span>
                        </label>
                    </p> -->

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="template_id" id="sys_email_template_id" />
                    <button type="submit" class="btn dark_btn">Update</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        //greetingMsg

        /*$(document).on('keydown', '.greetingMsgType', function() {
            var greetingMsgType = $(this).val();
            $('.greetingMsg').html(greetingMsgType);
        });*/
        
        /*$(document).on('keyup keydown', '.greetingTextType', function() {
            var greetingTextType = $(this).val();
            greetingTextType = greetingTextType.replace(/\n/g, "<br />");
            $('.greetingText').html(greetingTextType);
        });*/

        $(document).on('click', '.greetingMsgType', function() {
            $('.greetingMsg').focus();
        });

        $(document).on('click', '.greetingTextType', function() {
            $('.greetingText').focus();
        });

        $(document).on('click', '.oEditor', function() {
            $('.btn-codeview').trigger('click');
            $(this).hide();
            $(".view_editor").show();
        });

        $(document).on('click', '.view_editor', function() {
            $('.btn-codeview').trigger('click');
            $(this).hide();
            $(".oEditor").show();
        });

        $(document).on('change', function() {

            var eventEmailType = $('.eventEmailType').val();
            if(eventEmailType == 'admin') {
                $('.adminSubject').show();
                $('.emailTextAdmin').next().show();
                $('.clientSubject').hide();
                $('.emailTextClient').next().hide();
                $('.userSubject').hide();
                $('.emailTextUser').next().hide();
            } else if(eventEmailType == 'client') {
                $('.adminSubject').hide();
                $('.emailTextAdmin').next().hide();
                $('.clientSubject').show();
                $('.emailTextClient').next().show();
                $('.userSubject').hide();
                $('.emailTextUser').next().hide();
            } else if(eventEmailType == 'user') {
                $('.adminSubject').hide();
                $('.emailTextAdmin').next().hide();
                $('.clientSubject').hide();
                $('.emailTextClient').next().hide();
                $('.userSubject').show();
                $('.emailTextUser').next().show();
            } else {
                $('.adminSubject').hide();
                $('.emailTextAdmin').next().hide();
                $('.clientSubject').hide();
                $('.emailTextClient').next().hide();
                $('.userSubject').hide();
                $('.emailTextUser').next().hide();
            }
        });

        $(document).on('click', '.emailNotiSmartPopup', function() {
            $('.overlaynew').show();
            $('.eSubject').hide();
            $('.emailTextArea').next().hide();

            $(".box").animate({
                width: "toggle"
            });
            var type = $(this).attr('type');
            var templateId = $(this).attr('template_id');
          

            $.ajax({
                url: '<?php echo base_url("admin/settings/getEmailNotificationTemplate"); ?>',
                type: "POST",
                data: {templateId: templateId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //console.log(data.datarow);


                        $('select').find('option[value="'+data.datarow.template_tag+'"]').attr("selected",true);
                        $(".emailSubject").val(data.datarow.subject);
                        $('.emailText').summernote('code', data.datarow.plain_text_admin);

                        $( ".eventEmailTag option" ).each(function( index ) {
                           $(this).removeAttr('selected');
                        });

                        /*$( ".eventEmailType option" ).each(function( index ) {
                           $(this).removeAttr('selected');
                        });*/

                        $("select.eventEmailTag").find('option[value="'+data.datarow.template_tag+'"]').attr("selected",true);
                        //$("select.eventEmailType").find('option[value="'+type+'"]').attr("selected",true);
                        
                        $(".eventEmailType").val(type);
                        $(".emailSubjectAdmin").val(data.datarow.subject_admin);
                        $(".emailTextAdmin").summernote('code', data.datarow.plain_text_admin);
                        $(".emailSubjectClient").val(data.datarow.subject);
                        $(".emailTextClient").summernote('code', data.datarow.plain_text);
                        $(".emailSubjectUser").val(data.datarow.subject_user);
                        $(".emailTextUser").summernote('code', data.datarow.plain_text_user);

                        if(type == 'admin') {
                            $('.adminSubject').show();
                            $('.emailTextAdmin').next().show();
                        }
                        else if(type == 'client') {
                            $('.clientSubject').show();
                            $('.emailTextClient').next().show();
                        }
                        else if(type == 'user') {
                            $('.userSubject').show();
                            $('.emailTextUser').next().show();
                        }
                        else {

                        }

                        $(".emailTitle").val(data.datarow.title);
                        $(".template_id").val(templateId);
                        $('.overlaynew').hide();


                        /*$("#sys_email_template_title").val(data.datarow.title);
                        $("#sys_email_subject").val(data.datarow.subject);
                        $('#sys_email_template_tag').val(data.datarow.template_tag);
                        $('#sys_email_plain_text').summernote('code', data.datarow.plain_text);
                        $('#sys_email_subject_admin').val(data.datarow.subject_admin);
                        $('#sys_email_admin_text').summernote('code', data.datarow.plain_text_admin);
                        $('#sys_email_subject_user').val(data.datarow.subject_user);
                        $('#sys_email_user_text').summernote('code', data.datarow.plain_text_user);
                        $("input[name='edit_content_type'][value='" + data.datarow.content_type + "']").prop('checked', true);
                        if (data.datarow.send_sms == 1) {
                            $("#edit_send_sms").prop('checked', true);

                        } else {
                            $("#edit_send_sms").prop('checked', false);

                        }
                        $('#sys_email_template_id').val(templateId);
                        $('#editEmailNotificationTemplate').modal();*/
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error() {
                    alertMessage('Error: Some thing wrong!');
                }
            });

            return false;

        });

        $(document).on('submit', '#frmEditEmailTemplate', function (e) {
            
            var formdata = $("#frmEditEmailTemplate").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/settings/updateEmailNotificationTemplate'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //window.location.href = '<?php echo base_url(); ?>admin/settings/setup_system_notifications?t=email';

                        $('.showEmailMsg').html(data.msg);
                        setTimeout(function(){ $('.showEmailMsg').html(''); }, 3000);
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.insert_tag_button', function () {

            var dataTagName = $(this).attr('data-tag-name');
            var cursorPosition = $('#sys_plain_text').prop("selectionStart");
            var emailtemplate = $('#sys_plain_text').val();
            var newstr = emailtemplate.substring(0, cursorPosition) + dataTagName + emailtemplate.substring(cursorPosition, emailtemplate.length);
            $('#sys_plain_text').val(newstr);
            
        });
        
        $(document).on('click', '.insert_edit_tag_button', function () {

            var dataTagName = $(this).attr('data-tag-name');
            var cursorPosition = $('#sys_email_plain_text').prop("selectionStart");
            var emailtemplate = $('#sys_email_plain_text').val();
            var newstr = emailtemplate.substring(0, cursorPosition) + dataTagName + emailtemplate.substring(cursorPosition, emailtemplate.length);
            $('#sys_email_plain_text').val(newstr);
            

        });

        $("#edit_send_sms, #sys_send_sms").change(function () {
            if ($(this).is(':checked')) {
                $(this).val('1');
            } else {
                $(this).val('0');
            }
        });

        $('#frmAddEmailTemplate').on('submit', function (e) {
            var formdata = $("#frmAddEmailTemplate").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/settings/saveEmailNotificationTemplate'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //Display tag list
                        window.location.href = '<?php echo base_url(); ?>admin/settings/setup_system_notifications?t=email';
                    }
                }
            });
            return false;
        });


        $(document).on("click", ".editEmailNotificationTemplate", function (e) {
            var templateId = $(this).attr('template_id');
            $.ajax({
                url: '<?php echo base_url("admin/settings/getEmailNotificationTemplate"); ?>',
                type: "POST",
                data: {templateId: templateId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#sys_email_template_title").val(data.datarow.title);
                        $("#sys_email_subject").val(data.datarow.subject);
                        $('#sys_email_template_tag').val(data.datarow.template_tag);
                        $('#sys_email_plain_text').summernote('code', data.datarow.plain_text);
                        $('#sys_email_subject_admin').val(data.datarow.subject_admin);
                        $('#sys_email_admin_text').summernote('code', data.datarow.plain_text_admin);
                        $('#sys_email_subject_user').val(data.datarow.subject_user);
                        $('#sys_email_user_text').summernote('code', data.datarow.plain_text_user);
                        $("input[name='edit_content_type'][value='" + data.datarow.content_type + "']").prop('checked', true);
                        if (data.datarow.send_sms == 1) {
                            $("#edit_send_sms").prop('checked', true);

                        } else {
                            $("#edit_send_sms").prop('checked', false);

                        }
                        $('#sys_email_template_id').val(templateId);
                        $('#editEmailNotificationTemplate').modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error() {
                    alertMessage('Error: Some thing wrong!');
                }
            });

            return false;

        });

        $('#frmEditSysEmailTemplate').on('submit', function (e) {
            var formdata = $("#frmEditSysEmailTemplate").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/settings/updateEmailNotificationTemplate'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url(); ?>admin/settings/setup_system_notifications?t=email';
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.deleteEmailNotificationTemplate', function () {
            var elem = $(this);
            swal({
                title: "Are you sure? You want to delete this template!",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $('.overlaynew').show();
                            var templateID = $(elem).attr('template_id');
                            $.ajax({
                                url: '<?php echo base_url('admin/settings/deleteEmailNotificationTemplate'); ?>',
                                type: "POST",
                                data: {templateID: templateID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = '<?php echo base_url(); ?>admin/settings/setup_system_notifications?t=email';
                                    }
                                }
                            });
                        }
                    });
        });


        $(document).on('click', '.email_notification', function() {
            var type = $(this).attr('type');
            $('.email_notification').removeClass('btn btn-xs btn_white_table');
            if(type == 'admin') {
                $('.subUser').hide();
                $('.subClient').hide();
                $('.subAdmin').show();
                $(this).addClass('btn btn-xs btn_white_table');
            } else if(type == 'client') {
                $('.subUser').hide();
                $('.subClient').show();
                $('.subAdmin').hide();
                $(this).addClass('btn btn-xs btn_white_table');
            } else if(type == 'user') {
                $('.subUser').show();
                $('.subClient').hide();
                $('.subAdmin').hide();
                $(this).addClass('btn btn-xs btn_white_table');
            } else {
                $('.subUser').hide();
                $('.subClient').hide();
                $('.subAdmin').show();
                $(this).addClass('btn btn-xs btn_white_table');
            }   
        });


        $(document).on('click', '.sub_notification_form', function() {
            var type = $(this).attr('type');
            $('.sub_notification_form').removeClass('active');
            if(type == 'admin') {
                $('.subUserForm').hide();
                $('.subClientForm').hide();
                $('.subAdminForm').show();
                $(this).addClass('active');
                $('.emailTypeSub').val('admin');
                $('.emailTypeSubEdit').val('admin');
            } else if(type == 'client') {
                $('.subUserForm').hide();
                $('.subClientForm').show();
                $('.subAdminForm').hide();
                $(this).addClass('active');
                $('.emailTypeSub').val('client');
                $('.emailTypeSubEdit').val('client');
            } else if(type == 'user') {
                $('.subUserForm').show();
                $('.subClientForm').hide();
                $('.subAdminForm').hide();
                $(this).addClass('active');
                $('.emailTypeSub').val('user');
                $('.emailTypeSubEdit').val('user');
            } else {
                $('.subUserForm').hide();
                $('.subClientForm').hide();
                $('.subAdminForm').show();
                $(this).addClass('active');
                $('.emailTypeSub').val('admin');
                $('.emailTypeSubEdit').val('admin');
            }   
        });

        $(document).on('click', '.sendTestEmailPreviewSub', function() {
            var addSysEmailAdmin = $('#addSubEmailAdmin').summernote('code');
            var addSysEmailClient = $('#addSubEmailClient').summernote('code');
            var addSysEmailUser = $('#addSubEmailUser').summernote('code');
            var addSubEmailsubAdmin = $('#addSubEmailsubAdmin').val();
            var addSubEmailsubClient = $('#addSubEmailsubClient').val();
            var addSubEmailsubUser = $('#addSubEmailsubUser').val();
            var emailType = $('#emailTypeSub').val();
            var testEmailSys = $('#testEmailSub').val();
            $.ajax({
                url: '<?php echo base_url('admin/settings/sendTestEmailPreview'); ?>',
                type: "POST",
                data: {'addSysEmailAdmin':addSysEmailAdmin, 'addSysEmailClient': addSysEmailClient, 'addSysEmailUser':addSysEmailUser, 'testEmailSys':testEmailSys, 'emailType':emailType, 'addSubEmailsubAdmin':addSubEmailsubAdmin, 'addSubEmailsubClient':addSubEmailsubClient, 'addSubEmailsubUser':addSubEmailsubUser},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //Display tag list
                        $('.showEmailMsg').html(data.msg);
                        setTimeout(function(){ $('.showEmailMsg').html(''); }, 3000);
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.sendTestEmailPreviewSub', function() {
            var addSysEmailAdmin = $('#addSubEmailAdmin').summernote('code');
            var addSysEmailClient = $('#addSubEmailClient').summernote('code');
            var addSysEmailUser = $('#addSubEmailUser').summernote('code');
            var addSubEmailsubAdmin = $('#addSubEmailsubAdmin').val();
            var addSubEmailsubClient = $('#addSubEmailsubClient').val();
            var addSubEmailsubUser = $('#addSubEmailsubUser').val();
            var emailType = $('#emailTypeSubEdit').val();
            var testEmailSys = $('#testEmailSub').val();
            $.ajax({
                url: '<?php echo base_url('admin/settings/sendTestEmailPreview'); ?>',
                type: "POST",
                data: {'addSysEmailAdmin':addSysEmailAdmin, 'addSysEmailClient': addSysEmailClient, 'addSysEmailUser':addSysEmailUser, 'testEmailSys':testEmailSys, 'emailType':emailType, 'addSubEmailsubAdmin':addSubEmailsubAdmin, 'addSubEmailsubClient':addSubEmailsubClient, 'addSubEmailsubUser':addSubEmailsubUser},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //Display tag list
                        $('.showEmailMsg').html(data.msg);
                        setTimeout(function(){ $('.showEmailMsg').html(''); }, 3000);
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.sendTestEmailPreviewSubEdit', function() {
            var addSysEmailAdmin = $('#sys_email_admin_text').summernote('code');
            var addSysEmailClient = $('#sys_email_plain_text').summernote('code');
            var addSysEmailUser = $('#sys_email_user_text').summernote('code');
            var addSubEmailsubAdmin = $('#sys_email_subject_admin').val();
            var addSubEmailsubClient = $('#sys_email_subject').val();
            var addSubEmailsubUser = $('#sys_email_subject_user').val();
            var emailType = $('#emailTypeSub').val();
            var testEmailSys = $('#testEmailSubEdit').val();
            $.ajax({
                url: '<?php echo base_url('admin/settings/sendTestEmailPreview'); ?>',
                type: "POST",
                data: {'addSysEmailAdmin':addSysEmailAdmin, 'addSysEmailClient': addSysEmailClient, 'addSysEmailUser':addSysEmailUser, 'testEmailSys':testEmailSys, 'emailType':emailType, 'addSubEmailsubAdmin':addSubEmailsubAdmin, 'addSubEmailsubClient':addSubEmailsubClient, 'addSubEmailsubUser':addSubEmailsubUser},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //Display tag list
                        $('.showEmailMsg').html(data.msg);
                        setTimeout(function(){ $('.showEmailMsg').html(''); }, 3000);
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.sendNotiEmailPreview', function() {

            var addSysEmailAdmin = $('.emailTextAdmin').summernote('code');
            var addSysEmailClient = $('.emailTextClient').summernote('code');
            var addSysEmailUser = $('.emailTextUser').summernote('code');
            var addSubEmailsubAdmin = $('.emailSubjectAdmin').val();
            var addSubEmailsubClient = $('.emailSubjectClient').val();
            var addSubEmailsubUser = $('.emailSubjectUser').val();
            var emailType = $('.eventEmailType').val();
            var testEmailSys = $('.testEmailNotificationpre').val();

            if(testEmailSys != '') {
                $.ajax({
                    url: '<?php echo base_url('admin/settings/sendTestEmailPreview'); ?>',
                    type: "POST",
                    data: {'addSysEmailAdmin':addSysEmailAdmin, 'addSysEmailClient': addSysEmailClient, 'addSysEmailUser':addSysEmailUser, 'testEmailSys':testEmailSys, 'emailType':emailType, 'addSubEmailsubAdmin':addSubEmailsubAdmin, 'addSubEmailsubClient':addSubEmailsubClient, 'addSubEmailsubUser':addSubEmailsubUser},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            //Display tag list
                            $('.showEmailMsg').html(data.msg);
                            setTimeout(function(){ $('.showEmailMsg').html(''); }, 3000);
                        }
                    }
                });
            }
            else {
                $('.showEmailErrMsg').html('Please enter a email');
                $('.testEmailNotificationpre').focus();
                setTimeout(function(){ $('.showEmailErrMsg').html(''); }, 3000);
            }
            
            return false;            
        });

    });
</script>