<style type="text/css">
    .note-toolbar { height: 120px!important; }
</style>
<div class="tab-pane <?php if($seletedTab == 'system'):?>active<?php endif;?>" id="right-icon-tab0">
    <div class="row">
        <div class="col-md-12">
            <div style="margin: 0;" class="panel panel-flat">
                <div class="panel-heading"> 
                    <span class="pull-left">
                        <h6 class="panel-title"><?php echo count($oTemplates); ?> Templates</h6>
                    </span>
                    <div class="heading_links pull-left">
                        <a class="top_links sys_notification btn btn-xs btn_white_table ml20" type="all">All</a>
                        <a class="top_links sys_notification" type="admin" href="javascript:void(0);">Admin</a>
                        <a class="top_links sys_notification" type="client" href="javascript:void(0);">Client</a> 
                        <a class="top_links sys_notification" type="user" href="javascript:void(0);">User</a> 
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
                                <th class="sysAdmin"><i class="icon-iphone"></i>Admin Language</th>
                                <th class="sysClient"><i class="icon-iphone"></i>Client Language</th>
                                <th class="sysUser"><i class="icon-iphone"></i>User Language</th>
                                <th><i class="icon-calendar"></i> Created</th>
                                <th class="text-center"><i class="fa fa-dot-circle-o"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!--=======================-->
                            <?php foreach ($oTemplates as $oTemplate) { ?>
                                <tr>
                                    <td style="display:none;"></td>
                                    <td style="display:none;"></td>
                                    <td>
                                        <?php echo $oTemplate->title; ?>
                                    </td>

                                    <td>
                                        <?php echo $oTemplate->template_tag; ?>
                                    </td>

                                    <td class="sysAdmin">
                                        <?php 
                                        if(!empty($oTemplate->tag_language_admin)) {
                                            echo setStringLimit(base64_decode($oTemplate->tag_language_admin));
                                        } 
                                        else {
                                            echo '<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>';
                                        }
                                        ?>
                                    </td>

                                    <td class="sysClient">
                                        <?php 
                                        if(!empty($oTemplate->tag_language)) {
                                            echo setStringLimit(base64_decode($oTemplate->tag_language));
                                        } 
                                        else {
                                            echo '<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>';
                                        }
                                        ?>
                                    </td>

                                    <td class="sysUser">
                                        <?php 
                                        if(!empty($oTemplate->tag_language_user)) {
                                            echo setStringLimit(base64_decode($oTemplate->tag_language_user));
                                        } 
                                        else {
                                            echo '<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>';
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <div class="media-left">
                                            <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oTemplate->created)); ?></a></div>
                                            <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oTemplate->created)); ?></div>
                                        </div>

                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn green_cust_btn editSystemNotificationTemplate"  template_id="<?php echo $oTemplate->id; ?>"><i class="fa fa-eye"></i></a>
                                        <?php if ($oTemplate->write_permission == true): ?>
                                            <a class="btn red deleteSystemNotificationTemplate" template_id="<?php echo $oTemplate->id; ?>"><i class="fa fa-trash"></i></a>
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

<div id="addSystemNotificationTemplate" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddSysTemplate" id="frmAddSysTemplate" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add System Notification Template</h5>
                </div>

                <div class="modal-body">
                    
                    <div class="">
                        <a class="top_links sys_notification_form btn btn-xs btn_white_table active" type="admin" href="javascript:void(0);">Admin</a>
                        <a class="top_links sys_notification_form btn btn-xs btn_white_table" type="client" href="javascript:void(0);">Client</a> 
                        <a class="top_links sys_notification_form btn btn-xs btn_white_table" type="user" href="javascript:void(0);">User</a> 
                    </div>
                   
                    <p>Title:
                        <input class="form-control" name="title" placeholder="Enter Title for the notification" type="text" required></p>
                    <p>Event Name:
                        <input class="form-control" name="template_tag" placeholder="Enter Event Name" type="text" required></p>
                    <p class="sysAdmin sysAdminForm">Admin Language:
                        <textarea class="form-control summernote" name="tag_language_admin" id="addSysEmailAdmin" placeholder="Enter Language for admin for the same tag" ></textarea></p>

                    <p class="sysClient sysClientForm" style="display: none;">Client Language:
                        <textarea class="form-control summernote"  name="tag_language" id="addSysEmailClient" placeholder="Enter Language for the tag" ></textarea></p>
                    
                    <p class="sysUser sysUserForm" style="display: none;">User Language:
                        <textarea class="form-control summernote" name="tag_language_user" id="addSysEmailUser"   placeholder="Enter Language for user for the same tag" ></textarea></p>

                    <div class="showEmailMsg" style="color: green;"></div>
                    <p>Notification Preview:        
                            <input style="width: 88% !important;display: inline-block;margin-right: 15px;" class="form-control h40 input90" type="text" id="testEmailSys" name="testEmailSys" value="" placeholder="Enter test email">
                            <a class="btn dark_btn bkg_sblue2 h40 sendTestEmailPreview" style="padding: 7px 13px !important;min-width: 40px !important;display: inline-block;line-height: 26px;background: #6190fa!important;"><i style="font-size: 15px!important;" class="icon-paperplane fsize15"></i></a>
                            <input type="hidden" name="emailType" class="emailType" id="emailType" value="admin">
                    </p>
                           
                       

                   <!--  <p>Icon
                        <input type="radio" id="icon-envelop" name="icon" value="icon-envelop" style="margin-left:10px;" checked="checked" /> <label for="icon-envelop"><i class="icon-envelop fsize20"></i></label>
                        <input type="radio" id="icon-stack-text" name="icon" value="icon-stack-text" style="margin-left:10px;"  /> <label for="icon-stack-text"><i class="icon-stack-text fsize20"></i></label>
                        <input type="radio" id="icon-enter2" name="icon" value="icon-enter2" style="margin-left:10px;"  /> <label for="icon-enter2"><i class="icon-enter2 fsize20"></i> </label>
                        <input type="radio" id="icon-loop3" name="icon" value="icon-loop3" style="margin-left:10px;"  /> <label for="icon-loop3"><i class="icon-loop3 fsize20"></i> </label>
                        <input type="radio" id="icon-radio-checked2" name="icon" value="icon-radio-checked2" style="margin-left:10px;"  /> <label for="icon-radio-checked2 fsize20"><i class="icon-radio-checked2"></i></label>


                    </p>     -->

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn dark_btn">Create</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editSystemNotificationTemplate" class="modal fade">
    <div style="max-width: 760px;" class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmEditSysTemplate" id="frmEditSysTemplate" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Edit System Notification Template</h5>
                </div>
                <div class="modal-body">
                    
                    <div class="">
                        <a class="top_links sys_notification_form btn btn-xs btn_white_table active" type="admin" href="javascript:void(0);">Admin</a>
                        <a class="top_links sys_notification_form btn btn-xs btn_white_table" type="client" href="javascript:void(0);">Client</a> 
                        <a class="top_links sys_notification_form btn btn-xs btn_white_table" type="user" href="javascript:void(0);">User</a> 
                    </div>
                   
                    <p>Title:
                        <input class="form-control" name="title" id="sys_template_title" placeholder="Enter Title for the notification" type="text" required></p>
                    <p>Event Name:
                        <input class="form-control" id="sys_template_tag" name="template_tag" placeholder="Enter Event Name" type="text" readonly="readonly" style="background:#ccc;" required></p>

                    <p class="sysAdmin sysAdminForm"> Admin Notification:
                        <textarea class="form-control summernote" id="sys_tag_language_admin" name="tag_language_admin" placeholder="Enter Language for admin for the same tag" ></textarea></p>

                    <p class="sysClient sysClientForm" style="display: none;"> Client Notification:
                        <textarea class="form-control summernote" id="sys_tag_language" name="tag_language" placeholder="Enter Language for the tag" ></textarea>
                    
                    <p class="sysUser sysUserForm" style="display: none;"> User Notification:
                        <textarea class="form-control summernote" id="sys_tag_language_user" name="tag_language_user" placeholder="Enter Language for admin for the same tag" ></textarea></p>

                    <div class="showEmailMsg" style="color: green;"></div>
                    <p>Notification Preview:          
                        <input style="width: 88% !important;display: inline-block;margin-right: 15px;" class="form-control h40 input90" type="text" id="testEmailSysEdit" name="testEmailSysEdit" value="" placeholder="Enter test email">
                        <a class="btn dark_btn bkg_sblue2 h40 sendTestEmailPreviewEdit" style="padding: 7px 13px !important;min-width: 40px !important;display: inline-block;line-height: 26px; background: #6190fa!important;"><i style="font-size: 15px!important;" class="icon-paperplane fsize15"></i></a>
                        <input type="hidden" name="emailType" class="emailTypeEdit" id="emailTypeEdit" value="admin">
                    </p>
                    
                    <!-- <p>Icon
                        <input type="radio" id="icon-envelop" name="edit_icon" value="icon-envelop" checked="checked" style="margin-left:10px;" /> <label for="icon-envelop"><i class="icon-envelop fsize20"></i></label>
                        <input type="radio" id="icon-stack-text" name="edit_icon" value="icon-stack-text" style="margin-left:10px;"  /> <label for="icon-stack-text"><i class="icon-stack-text fsize20"></i></label>
                        <input type="radio" id="icon-enter2" name="edit_icon" value="icon-enter2" style="margin-left:10px;"  /> <label for="icon-enter2"><i class="icon-enter2 fsize20"></i> </label>
                        <input type="radio" id="icon-loop3" name="edit_icon" value="icon-loop3" style="margin-left:10px;"  /> <label for="icon-loop3"><i class="icon-loop3 fsize20"></i> </label>
                        <input type="radio" id="icon-radio-checked2" name="edit_icon" value="icon-radio-checked2" style="margin-left:10px;"  /> <label for="icon-radio-checked2 fsize20"><i class="icon-radio-checked2"></i></label>


                    </p> -->

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="template_id" id="sys_template_id" />
                    <button type="submit" class="btn dark_btn">Update</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        $(document).on('click', '.sys_notification', function() {
            var type = $(this).attr('type');
            $('.sys_notification').removeClass('btn btn-xs btn_white_table');
            if(type == 'admin') {
                $('.sysUser').hide();
                $('.sysClient').hide();
                $('.sysAdmin').show();
                $(this).addClass('btn btn-xs btn_white_table');
            } else if(type == 'client') {
                $('.sysUser').hide();
                $('.sysClient').show();
                $('.sysAdmin').hide();
                $(this).addClass('btn btn-xs btn_white_table');
            } else if(type == 'user') {
                $('.sysUser').show();
                $('.sysClient').hide();
                $('.sysAdmin').hide();
                $(this).addClass('btn btn-xs btn_white_table');
            } else {
                $('.sysUser').hide();
                $('.sysClient').hide();
                $('.sysAdmin').show();
                $(this).addClass('btn btn-xs btn_white_table');
            }   
        });

        

        $(document).on('click', '.sys_notification_form', function() {
            var type = $(this).attr('type');
            $('.sys_notification_form').removeClass('active');
            if(type == 'admin') {
                $('.sysUserForm').hide();
                $('.sysClientForm').hide();
                $('.sysAdminForm').show();
                $(this).addClass('active');
                $('.emailType').val('admin');
                $('.emailTypeEdit').val('admin');
            } else if(type == 'client') {
                $('.sysUserForm').hide();
                $('.sysClientForm').show();
                $('.sysAdminForm').hide();
                $(this).addClass('active');
                $('.emailType').val('client');
                $('.emailTypeEdit').val('client');
            } else if(type == 'user') {
                $('.sysUserForm').show();
                $('.sysClientForm').hide();
                $('.sysAdminForm').hide();
                $(this).addClass('active');
                $('.emailType').val('user');
                $('.emailTypeEdit').val('user');
            } else {
                $('.sysUserForm').hide();
                $('.sysClientForm').hide();
                $('.sysAdminForm').show();
                $(this).addClass('active');
                $('.emailType').val('admin');
                $('.emailTypeEdit').val('admin');
            }   
        });


        $('#frmAddSysTemplate').on('submit', function (e) {
            var formdata = $("#frmAddSysTemplate").serialize();
            var addsummernote = $('#addsummernote').summernote('code');
            $.ajax({
                url: '<?php echo base_url('admin/settings/saveSystemNotificationTemplate'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //Display tag list
                        window.location.href = '<?php echo base_url(); ?>admin/settings/setup_system_notifications?t=system';
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.sendTestEmailPreview', function() {
            var addSysEmailAdmin = $('#addSysEmailAdmin').summernote('code');
            var addSysEmailClient = $('#addSysEmailClient').summernote('code');
            var addSysEmailUser = $('#addSysEmailUser').summernote('code');
            var emailType = $('#emailType').val();
            var testEmailSys = $('#testEmailSys').val();
            $.ajax({
                url: '<?php echo base_url('admin/settings/sendTestEmailPreview'); ?>',
                type: "POST",
                data: {'addSysEmailAdmin':addSysEmailAdmin, 'addSysEmailClient': addSysEmailClient, 'addSysEmailUser':addSysEmailUser, 'testEmailSys':testEmailSys, 'emailType':emailType},
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

        $(document).on('click', '.sendTestEmailPreviewEdit', function() {
            var addSysEmailAdmin = $('#sys_tag_language_admin').summernote('code');
            var addSysEmailClient = $('#sys_tag_language').summernote('code');
            var addSysEmailUser = $('#sys_tag_language_user').summernote('code');
            var emailType = $('#emailTypeEdit').val();
            var testEmailSys = $('#testEmailSysEdit').val();
            $.ajax({
                url: '<?php echo base_url('admin/settings/sendTestEmailPreview'); ?>',
                type: "POST",
                data: {'addSysEmailAdmin':addSysEmailAdmin, 'addSysEmailClient': addSysEmailClient, 'addSysEmailUser':addSysEmailUser, 'testEmailSys':testEmailSys, 'emailType':emailType},
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


        $(document).on("click", ".editSystemNotificationTemplate", function (e) {
            var templateId = $(this).attr('template_id');
            $.ajax({
                url: '<?php echo base_url("admin/settings/getSystemNotificationTemplate"); ?>',
                type: "POST",
                data: {templateId: templateId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        console.log(data.datarow);
                        $("#sys_template_title").val(data.datarow.title);
                        $('#sys_template_tag').val(data.datarow.template_tag);
                        $('#sys_tag_language').summernote('code', data.datarow.tag_language);
                        $('#sys_tag_language_admin').summernote('code', data.datarow.tag_language_admin);
                        $('#sys_tag_language_user').summernote('code', data.datarow.tag_language_user);
                        $('#sys_template_id').val(templateId);
                        $("input[name='edit_icon'][value='" + data.datarow.icon + "']").prop('checked', true);
                        $('#editSystemNotificationTemplate').modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error() {
                    alertMessage('Error: Some thing wrong!');
                }
            });

            return false;

        });

        $('#frmEditSysTemplate').on('submit', function (e) {
            var formdata = $("#frmEditSysTemplate").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/settings/updateSystemNotificationTemplate'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url(); ?>admin/settings/setup_system_notifications?t=system';
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.deleteSystemNotificationTemplate', function () {
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
                                url: '<?php echo base_url('admin/settings/deleteSystemNotificationTemplate'); ?>',
                                type: "POST",
                                data: {templateID: templateID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = '<?php echo base_url(); ?>admin/settings/setup_system_notifications?t=system';
                                    }
                                }
                            });
                        }
                    });
        });



    });
</script>