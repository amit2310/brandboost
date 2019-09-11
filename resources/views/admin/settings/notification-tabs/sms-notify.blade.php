<div class="tab-pane @if ($seletedTab == 'sms') active @endif" id="right-icon-tab2">
    <div class="row">
        <div class="col-md-12">
            <div style="margin: 0;" class="panel panel-flat">
                <div class="panel-heading"> 
                    <span class="pull-left">
                        <h6 class="panel-title">{{ count($oTemplates) }} Email Templates</h6>
                    </span>
                    <div class="heading_links pull-left">
                        <a class="top_links sms_notification btn btn-xs btn_white_table ml20" type="all">All</a>
                        <a class="top_links sms_notification" type="admin">Admin</a>
                        <a class="top_links sms_notification" type="client" href="javascript:void(0);">Client</a> 
                        <a class="top_links sms_notification" type="user" href="javascript:void(0);">User</a> 
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
                                <th class="smsAdmin"><i class="icon-iphone"></i>Admin Message</th>
                                <th class="smsClient"><i class="icon-iphone"></i>Client Message</th>
                                <th class="smsUser"><i class="icon-iphone"></i>User Message</th>
                                <th><i class="icon-calendar"></i> Created</th>
                                <th class="text-center"><i class="fa fa-dot-circle-o"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!--=======================-->
                            @foreach ($oEmailTemplates as $oTemplate)
                                <tr>
                                    <td style="display:none;"></td>
                                    <td style="display:none;"></td>
                                    <td>
                                        {{ $oTemplate->title }}
                                    </td>

                                    <td>
                                        {{ $oTemplate->template_tag }}
                                    </td>

                                     <td class="smsAdmin">
                                        @if(!empty($oTemplate->sms_text_admin))
											{{ setStringLimit($oTemplate->sms_text_admin) }}
                                        @else
											<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>
                                        @endif
                                    </td>

                                    <td class="smsClient">
                                        @if(!empty($oTemplate->sms_text_client))
											{{ setStringLimit($oTemplate->sms_text_client) }}
                                        @else
											<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>
                                        @endif
                                    </td>

                                    <td class="smsUser">
                                        @if(!empty($oTemplate->sms_text_user))
											{{ setStringLimit($oTemplate->sms_text_user) }}
                                        @else
											<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="media-left">
                                            <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', strtotime($oTemplate->created)) }}</a></div>
                                            <div class="text-muted text-size-small">{{ date('h:i A', strtotime($oTemplate->created)) }}</div>
                                        </div>

                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn green_cust_btn editSMSNotificationTemplate"  template_id="{{ $oTemplate->id }}"><i class="fa fa-eye"></i></a>
                                        @if ($oTemplate->write_permission == true)
                                            <a class="btn red deleteEmailNotificationTemplate" template_id="{{ $oTemplate->id }}"><i class="fa fa-trash"></i></a>
                                        @else
                                            <a href="javascript:void(0)" title="Deleting this template not allowed" class="btn red"><i class="fa fa-trash" style="color:#ccc;"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addSMSNotificationTemplate" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddSMSTemplate" id="frmAddSMSTemplate" action="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Email Notification Template</h5>
                </div>

                <div class="modal-body">

                    <div class="">
                        <a class="top_links sms_notification_form btn btn-xs btn_white_table active" type="admin" href="javascript:void(0);">Admin</a>
                        <a class="top_links sms_notification_form btn btn-xs btn_white_table" type="client" href="javascript:void(0);">Client</a> 
                        <a class="top_links sms_notification_form btn btn-xs btn_white_table" type="user" href="javascript:void(0);">User</a> 
                    </div>

                    <p>Title:
                        <input class="form-control" name="title" placeholder="Enter Title for the notification" type="text" required></p>
                    <p>Event Name:
                        <input class="form-control" name="template_tag" placeholder="Enter Event Name" type="text" required></p>
                    <span class="smsAdmin smsAdminForm">
                        <p>Admin Message :
                        <textarea class="form-control" name="sms_text_admin" id="sms_text_admin" rows="6" placeholder="Enter Plain Text" ></textarea></p>
                    </span>
                    <span class="smsClient smsClientForm" style="display: none;">
                        <p>Client Message :
                        <textarea class="form-control" name="sms_text_client" id="sms_text_client" rows="6" placeholder="Enter Plain Text" ></textarea></p>
                    </span>
                    <span class="smsUser smsUserForm" style="display: none;">
                        <p>User Message :
                        <textarea class="form-control" name="sms_text_user" id="sms_text_user" rows="6" placeholder="Enter Plain Text" ></textarea></p>
                    </span>

                    <div class="showEmailMsg" style="color: green;"></div>
                    <p>
						Notification Preview:        
						<input style="width: 88% !important;display: inline-block;margin-right: 15px;" class="form-control h40 input90" type="text" id="testSMSSub" name="testSMSSub" value="" placeholder="Enter phone number">
						<a class="btn dark_btn bkg_sblue2 h40  sendTestSMSPreview" style="padding: 7px 13px !important;min-width: 40px !important;display: inline-block;line-height: 26px;background: #6190fa!important;"><i style="font-size: 15px!important;" class="icon-paperplane fsize15"></i></a>
						<input type="hidden" name="smsType" class="smsType" id="smsType" value="admin">
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn dark_btn">Create</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editSMSNotificationTemplate" class="modal fade">
    <div style="max-width: 760px;" class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmEditSysSMSTemplate" id="frmEditSysSMSTemplate" action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Edit System Notification Template</h5>
                </div>
                <div class="modal-body">

                    <div class="">
                        <a class="top_links sms_notification_form btn btn-xs btn_white_table active" type="admin" href="javascript:void(0);">Admin</a>
                        <a class="top_links sms_notification_form btn btn-xs btn_white_table" type="client" href="javascript:void(0);">Client</a> 
                        <a class="top_links sms_notification_form btn btn-xs btn_white_table" type="user" href="javascript:void(0);">User</a> 
                    </div>

                    <p>Title:
                        <input class="form-control" name="title" id="sys_sms_template_title" placeholder="Enter Title for the notification" type="text" required></p>

                    <p>Event Name:
                        <input class="form-control" name="template_tag" id="sys_sms_template_tag" placeholder="Enter Event Name" type="text" readonly="readonly" style="background:#ccc;"  required></p>
                    
                    <span class="smsAdmin smsAdminForm">
                    <p>Admin Message :
                        <textarea class="form-control" id="sys_sms_admin_message" name="sms_text_admin" rows="6" placeholder="Enter Plain Text" ></textarea></p>
                    </span>
                    <span class="smsClient smsClientForm" style="display: none;">
                    <p>Client Message :
                        <textarea class="form-control" id="sys_sms_client_message" name="sms_text_client" rows="6" placeholder="Enter Plain Text" ></textarea></p>
                    </span>
                    <span class="smsUser smsUserForm" style="display: none;">
                    <p>User Message :
                        <textarea class="form-control" id="sys_sms_user_message" name="sms_text_user" rows="6" placeholder="Enter Plain Text" ></textarea></p>
                    </span>

                    <div class="showEmailMsg" style="color: green;"></div>
                    <p>Notification Preview:        
						<input style="width: 88% !important;display: inline-block;margin-right: 15px;" class="form-control h40 input90" type="text" id="testSMSSubEdit" name="testSMSSubEdit" value="" placeholder="Enter phone number">
						<a class="btn dark_btn bkg_sblue2 h40 sendTestSMSPreviewEdit" style="padding: 7px 13px !important;min-width: 40px !important;display: inline-block;line-height: 26px;background: #6190fa!important;"><i style="font-size: 15px!important;" class="icon-paperplane fsize15"></i></a>
						<input type="hidden" name="smsTypeEdit" class="smsTypeEdit" id="smsTypeEdit" value="admin">
                    </p>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="template_id" id="sys_sms_template_id" />
                    <button type="submit" class="btn dark_btn">Update</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
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
		

        $('#frmAddSMSTemplate').on('submit', function (e) {
            e.preventDefault();
            var formdata = $("#frmAddSMSTemplate").serialize();
            $.ajax({
                url: "{{ base_url('admin/settings/saveSMSNotificationTemplate') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //Display tag list
                        window.location.href = '{{ base_url() }}admin/settings/setup_system_notifications?t=sms';
                    }
                }
            });
            return false;
        });


        $(document).on("click", ".editSMSNotificationTemplate", function (e) {
            var templateId = $(this).attr('template_id');
            $.ajax({
                url: '{{ base_url("admin/settings/getSMSNotificationTemplate") }}',
                type: "POST",
                data: {templateId: templateId, _token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#sys_sms_template_title").val(data.datarow.title);
                        $('#sys_sms_template_tag').val(data.datarow.template_tag);
                        $('#sys_sms_admin_message').val(data.datarow.sms_text_admin);
                        $('#sys_sms_client_message').val(data.datarow.sms_text_client);
                        $('#sys_sms_user_message').val(data.datarow.sms_text_user);
                        $('#sys_sms_template_id').val(templateId);
                        $('#editSMSNotificationTemplate').modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error() {
                    alertMessage('Error: Some thing wrong!');
                }
            });
            return false;
        });
		

        $('#frmEditSysSMSTemplate').on('submit', function (e) {
            e.preventDefault();
            var formdata = $("#frmEditSysSMSTemplate").serialize();
            $.ajax({
                url: "{{ base_url('admin/settings/updateSMSNotificationTemplate') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '{{ base_url() }}admin/settings/setup_system_notifications?t=sms';
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
						url: "{{ base_url('admin/settings/deleteEmailNotificationTemplate') }}",
						type: "POST",
						data: {templateID: templateID, _token: '{{ csrf_token() }}'},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = '{{ base_url() }}admin/settings/setup_system_notifications?t=sms';
							}
						}
					});
				}
			});
        });


        $(document).on('click', '.sms_notification', function() {
            var type = $(this).attr('type');
            $('.sms_notification').removeClass('btn btn-xs btn_white_table');
            if(type == 'admin') {
                $('.smsUser').hide();
                $('.smsClient').hide();
                $('.smsAdmin').show();
                $(this).addClass('btn btn-xs btn_white_table');
            } else if(type == 'client') {
                $('.smsUser').hide();
                $('.smsClient').show();
                $('.smsAdmin').hide();
                $(this).addClass('btn btn-xs btn_white_table');
            } else if(type == 'user') {
                $('.smsUser').show();
                $('.smsClient').hide();
                $('.smsAdmin').hide();
                $(this).addClass('btn btn-xs btn_white_table');
            } else {
                $('.smsUser').show();
                $('.smsClient').show();
                $('.smsAdmin').show();
                $(this).addClass('btn btn-xs btn_white_table');
            }   
        });

        $(document).on('click', '.sms_notification_form', function() {
            var type = $(this).attr('type');
            $('.sms_notification_form').removeClass('active');
            if(type == 'admin') {
                $('.smsUserForm').hide();
                $('.smsClientForm').hide();
                $('.smsAdminForm').show();
                $(this).addClass('active');
                $('#smsType').val('admin');
                $('#smsTypeEdit').val('admin');
            } else if(type == 'client') {
                $('.smsUserForm').hide();
                $('.smsClientForm').show();
                $('.smsAdminForm').hide();
                $(this).addClass('active');
                $('#smsType').val('client');
                $('#smsTypeEdit').val('client');
            } else if(type == 'user') {
                $('.smsUserForm').show();
                $('.smsClientForm').hide();
                $('.smsAdminForm').hide();
                $(this).addClass('active');
                $('#smsType').val('user');
                $('#smsTypeEdit').val('user');
            } else {
                $('.smsUserForm').hide();
                $('.smsClientForm').hide();
                $('.smsAdminForm').show();
                $(this).addClass('active');
                $('#smsType').val('admin');
                $('#smsTypeEdit').val('admin');
            }   
        });

        $(document).on('click', '.sendTestSMSPreview', function() {
            var sms_text_admin = $('#sms_text_admin').val();
            var sms_text_client = $('#sms_text_client').val();
            var sms_text_user = $('#sms_text_user').val();
            var smsType = $('#smsType').val();
            var testSMSSub = $('#testSMSSub').val();
            $.ajax({
                url: "{{ base_url('admin/settings/sendTestSMSPreview') }}",
                type: "POST",
                data: {'sms_text_admin':sms_text_admin, 'sms_text_client': sms_text_client, 'sms_text_user':sms_text_user, 'testSMSSub':testSMSSub, 'smsType':smsType, _token: '{{ csrf_token() }}'},
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

        $(document).on('click', '.sendTestSMSPreviewEdit', function() {
            var sms_text_admin = $('#sys_sms_admin_message').val();
            var sms_text_client = $('#sys_sms_client_message').val();
            var sms_text_user = $('#sys_sms_user_message').val();
            var smsType = $('#smsTypeEdit').val();
            var testSMSSub = $('#testSMSSubEdit').val();
            $.ajax({
                url: "{{ base_url('admin/settings/sendTestSMSPreview') }}",
                type: "POST",
                data: {'sms_text_admin':sms_text_admin, 'sms_text_client': sms_text_client, 'sms_text_user':sms_text_user, 'testSMSSub':testSMSSub, 'smsType':smsType, _token: '{{ csrf_token() }}'},
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
    });
</script>