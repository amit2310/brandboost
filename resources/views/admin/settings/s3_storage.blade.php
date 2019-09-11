@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
<script type="text/javascript" src="/assets/js/plugins/editors/summernote/summernote.min.js"></script>
<script type="text/javascript" src="/assets/js/pages/editor_summernote.js"></script>
<style type="text/css">
    .btn.btn-xs.btn_white_table.active{background: #6190fa!important; color: #fff;}
    .toggle { cursor:pointer!important; }
</style>

@include('admin.s3_smart_popup')

<div class="content">
  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header">
	  <div class="row">
	  <!--=============Headings & Tabs menu==============-->
		<div class="col-md-5">
		  <h3 class=""><img  width="20"  src="/assets/images/menu_icons/Website_Light.svg"/>S3 Storage Management</h3>
		</div>
		<!--=============Button Area Right Side==============-->
	  </div>
	</div>
	<!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
	
	<!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
	
	<div class="tab-content"> 
	  <!--===========TAB 1===========-->
	  <div class="tab-pane active" id="right-icon-tab0">
		<div class="row">
		  <div class="col-md-12">
			<div class="panel panel-flat">
			  <div class="panel-heading"> 
				  <span class="pull-left">
				  <h6 class="panel-title">S3 Storage Management</h6>
				  </span>
				  
				  <div class="heading-elements">
				<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
					<input class="form-control input-sm cus_search" tableid="generalNotification" placeholder="Search by name" type="text">
					<div class="form-control-feedback">
						<i class=""><img src="/assets/images/icon_search.png" width="14"></i>
					</div>
				</div>
				<div class="table_action_tool">
					<a href="#" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="/assets/images/icon_refresh.png"></i></a>
					<a href="#"><i class=""><img src="/assets/images/icon_calender.png"></i></a>
					<a href="#"><i class=""><img src="/assets/images/icon_download.png"></i></a>
					<a href="#"><i class=""><img src="/assets/images/icon_upload.png"></i></a>
					<a href="#"><i class=""><img src="/assets/images/icon_edit.png"></i></a>
				</div>
				
				</div>
				</div>
				<div class="panel-body p0 bkg_white">
				<table class="table" id="generalNotification">
				<thead>
				<tr>
				<th style="display:none;"></th>
				<th style="display:none;"></th>
				<th>User Id</th>
				<th>User Name</th>
				<th>Allow Storage (MB)</th>
				<th>Remaning Storage (MB)</th>
				<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<!--========== ROW START =============-->
				@php 
				$notifications = getAllUser(); 
				 foreach ($notifications as $oTemplate) {
				  if($oTemplate->id!='1' && $oTemplate->firstname!='')
				  {
				  @endphp
				<tr>
				  <td style="display:none;">{{ $oTemplate->id }}</td>
				  <td style="display:none;">{{ $oTemplate->id }}</td>
				<td><div class="media-left media-middle"> <i class="fa fa-square mr10" style="color: #6190fa;"></i></div>
				<div class="media-left">
				<div class=""><a href="#" class="text-default text-semibold">{{ $oTemplate->id }}</a> </div>

				</div></td>

				<td>{{ $oTemplate->firstname.' '.$oTemplate->lastname }}</td>

				<td>{{ $oTemplate->s3_allow_size }}</td>
				 <td>{{ ($oTemplate->s3_allow_size-$oTemplate->s3_used_size) }}</td>

				<td>
				<div class="tdropdown"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="/assets/images/more.svg"></a>
				<ul class="dropdown-menu dropdown-menu-right more_act">
				<a href="#" class="dropdown_close">X</a>
				<li><a user_id="{{ $oTemplate->id }}" class="systemNotiSmartPopup"><i class="icon-arrow-down16"></i>Edit</a> </li>
				</ul>
				</div></td>

				</tr>
				@php 
					}
				} 
				@endphp
				   <!--========== ROW END =============-->

				</tbody>
				</table>

			  </div>
			</div>
		  </div>
		</div>
	  </div>
	  <!--===========TAB 2===========-->
	  <div class="tab-pane" id="right-icon-tab1">
		<div class="row">
		  <div class="col-md-12">
			<div class="panel panel-flat">
			  <div class="panel-heading"> 
				  <span class="pull-left">
				  <h6 class="panel-title">Tab 2 Content Goes here...</h6>
				  </span>
				  
				  <div class="heading-elements">
				<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
						<input class="form-control input-sm" placeholder="Search by name" type="text">
						<div class="form-control-feedback">
							<i class=""><img src="/assets/images/icon_search.png" width="14"></i>
						</div>
					</div>
					<div class="table_action_tool">
						<a href="#" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="/assets/images/icon_refresh.png"></i></a>
						<a href="#"><i class=""><img src="/assets/images/icon_calender.png"></i></a>
						<a href="#"><i class=""><img src="/assets/images/icon_download.png"></i></a>
						<a href="#"><i class=""><img src="/assets/images/icon_upload.png"></i></a>
						<a href="#"><i class=""><img src="/assets/images/icon_edit.png"></i></a>
					</div>			
				</div>
				</div>
			  <div class="panel-body p20 bkg_white">
				Tab 2 Content Goes here...
			  </div>
			</div>
		  </div>
		</div>
	  </div>
		<!--===========TAB 3===========-->
	  <div class="tab-pane" id="right-icon-tab2">
		<div class="row">
		  <div class="col-md-12">
			<div class="panel panel-flat">
			  <div class="panel-heading"> 
				  <span class="pull-left">
				  <h6 class="panel-title">Tab 3 Content Goes here...</h6>
				  </span>
				  
				  <div class="heading-elements">
					<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
						<input class="form-control input-sm" placeholder="Search by name" type="text">
						<div class="form-control-feedback">
							<i class=""><img src="/assets/images/icon_search.png" width="14"></i>
						</div>
					</div>
					<div class="table_action_tool">
						<a href="#" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="/assets/images/icon_refresh.png"></i></a>
						<a href="#"><i class=""><img src="/assets/images/icon_calender.png"></i></a>
						<a href="#"><i class=""><img src="/assets/images/icon_download.png"></i></a>
						<a href="#"><i class=""><img src="/assets/images/icon_upload.png"></i></a>
						<a href="#"><i class=""><img src="/assets/images/icon_edit.png"></i></a>
					</div>
									
				</div>

				</div>
				<div class="panel-body p20 bkg_white">
					Tab 3 Content Goes here...
				</div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
  </div>
<script type="text/javascript">
    $(document).ready(function(){
         $('.UpDatepermission').change(function () {
            var flag=0;
            var permission;
            var notificationId=$(this).attr('notificationid');
              permission = $(this).attr('permission');
            if ($(this).prop("checked") == false) {
               flag=0;
            } else {
               flag=1;
            }

            $.ajax({
				url: '{{ base_url("admin/settings/updateNotification") }}',
				type: "POST",
				data: {id: notificationId,permission:permission,user_type:'admin',permission_value:flag,_token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
					   displayMessagePopup(); 					   
					} else {
						alertMessage('Error: Some thing wrong!');
					}
				}, error() {
					alertMessage('Error: Some thing wrong!');
				}
			});
        });

          
		var tableId = 'generalNotification';
		var tableBase = custom_data_table(tableId, 0, 'asc');
		tableBase.page.len(-1).draw();
		$('#_10'+tableId).removeClass('current');
		$('#all'+tableId).addClass('current');

       
        $(document).on("click", ".emailNotifictionBack", function(){ 
            $(".emailNotificationShow").animate({
                width: "toggle"
            });
        });

        $(document).on("click", ".smsNotifictionBack", function(){ 
            $(".smsNotificationShow").animate({
                width: "toggle"
            });
        });

        $(document).on("click", ".systemNotifictionBack", function(){ 
            $(".systemNotificationShow").animate({
                width: "toggle"
            });
        });
    });
</script>
<!-- Email -->

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
                            <textarea class="form-control summernote" id="addSubEmailUser" name="user_text"  rows="6" placeholder="Enter Plain Text" ></textarea>
						</p>
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
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn dark_btn">Create</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Email -->

<!-- Sms -->

<div id="addSmsNotificationTemplate" class="modal fade">
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
                            <textarea class="form-control summernote" id="addSubEmailAdmin" name="admin_text" rows="6" placeholder="Enter Plain Text"></textarea>
						</p>
                        <p>
                            <button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
                        </p>
                    </span>

                    <span class="subClient subClientForm" style="display: none;">
                        <p>Client Subject:
                            <input class="form-control" id="addSubEmailsubClient" name="subject" placeholder="Enter Subject" type="text" ></p>
                        
                        <p> Client Text:
                            <textarea class="form-control summernote" id="addSubEmailClient" name="plain_text" rows="6" placeholder="Enter Plain Text" ></textarea>
						</p>
                        <p>
                            <button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
                        </p>
                    </span>

                    <span class="subUser subUserForm" style="display: none;">
                        <p>User Subject:
                            <input class="form-control" id="addSubEmailsubUser" name="user_subject" placeholder="Enter Subject" type="text" ></p>
                        <p>User Text:
                            <textarea class="form-control summernote" id="addSubEmailUser" name="user_text"  rows="6" placeholder="Enter Plain Text" ></textarea>
						</p>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn dark_btn">Create</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Sms -->

<!-- System -->

<div id="addSystemNotificationTemplate" class="modal fade">
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
                            <textarea class="form-control summernote" id="addSubEmailAdmin" name="admin_text" rows="6" placeholder="Enter Plain Text"></textarea>
						</p>
                        <p>
                            <button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
                        </p>
                    </span>

                    <span class="subClient subClientForm" style="display: none;">
                        <p>Client Subject:
                            <input class="form-control" id="addSubEmailsubClient" name="subject" placeholder="Enter Subject" type="text" ></p>
                        
                        <p> Client Text:
                            <textarea class="form-control summernote" id="addSubEmailClient" name="plain_text" rows="6" placeholder="Enter Plain Text" ></textarea>
						</p>
                        <p>
                            <button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
                        </p>
                    </span>

                    <span class="subUser subUserForm" style="display: none;">
                        <p>User Subject:
                            <input class="form-control" id="addSubEmailsubUser" name="user_subject" placeholder="Enter Subject" type="text" ></p>
                        <p>User Text:
                            <textarea class="form-control summernote" id="addSubEmailUser" name="user_text"  rows="6" placeholder="Enter Plain Text" ></textarea>
						</p>
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
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn dark_btn">Create</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- System -->

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
                        <input class="form-control" name="title" id="sys_email_template_title" placeholder="Enter Title for the notification" type="text" required>
					</p>

                    <p>Event Name:
                        <input class="form-control" name="template_tag" id="sys_email_template_tag" placeholder="Enter Event Name" type="text" readonly="readonly" style="background:#ccc;"  required>
					</p>
                    
                    <span class="subAdmin subAdminForm">
                        <p>Admin Subject:
                            <input class="form-control" name="admin_subject" id="sys_email_subject_admin" placeholder="Enter Subject" type="text" ></p>

                        <p>Admin Text:
                            <textarea class="form-control summernote" name="admin_text" rows="6" id="sys_email_admin_text" placeholder="Enter Plain Text"></textarea>
						</p>

                        <p>
							<button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
						</p>
                    </span>

                    <span class="subClient subClientForm" style="display: none;">
                        <p>Client Subject:
                            <input class="form-control" name="subject" id="sys_email_subject" placeholder="Enter Subject" type="text" ></p>

                        <p>Client Text:
                            <textarea class="form-control summernote" name="plain_text" rows="6" id="sys_email_plain_text" placeholder="Enter Plain Text"></textarea>
						</p>

                        <p>
							<button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
						</p>
                    </span>

                    <span class="subUser subUserForm" style="display: none;">
                        <p>User Subject:
                            <input class="form-control" name="user_subject" id="sys_email_subject_user" placeholder="Enter Subject" type="text">
						</p> 

                        <p>User Text:
                            <textarea class="form-control summernote" name="user_text" rows="6" id="sys_email_user_text" placeholder="Enter Plain Text"></textarea>
						</p>

                        <p>
							<button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_edit_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
						</p>
                    </span>

                    <div class="showEmailMsg" style="color: green;"></div>
                    <p>Notification Preview:        
						<input style="width: 88% !important;display: inline-block;margin-right: 15px;" class="form-control h40 input90" type="text" id="testEmailSubEdit" name="testEmailSubEdit" value="" placeholder="Enter test email">
						<a class="btn dark_btn bkg_sblue2 h40 sendTestEmailPreviewSubEdit" style="padding: 7px 13px !important;min-width: 40px !important;display: inline-block;line-height: 26px;background: #6190fa!important;"><i style="font-size: 15px!important;" class="icon-paperplane fsize15"></i></a>
						<input type="hidden" name="emailTypeSubEdit" class="emailTypeSubEdit" id="emailTypeSubEdit" value="admin">
                    </p>
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

<script type="text/javascript">
    $(document).ready(function(){
       
        $(document).on('click', '.systemNotiSmartPopup', function() {
            //$('.overlaynew').show();
            $(".systemNotificationShow").animate({
                width: "toggle"
            });

            var userid = $(this).attr('user_id');

            $.ajax({
                url: '{{ base_url("admin/settings/getuserbyid") }}',
                type: "POST",
                data: {userid: userid,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                       
                        var aData = data.datarow;
                        $("#userid").html(aData.id);
                        $("#username").html(aData.firstname +' '+ aData.lastname);
                        $("#s3_allow_size").val(aData.s3_allow_size);
                        $("#user_id_input").val(aData.id);
                       
                        $('.overlaynew').hide();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error() {
                    alertMessage('Error: Some thing wrong!');
                }
            });
            return false;
        });
        

        $(document).on('click', '.smsNotiSmartPopup', function() {
            //$('.overlaynew').show();
            $(".smsNotificationShow").animate({
                width: "toggle"
            });

            var type = $(this).attr('type');
            var templateId = $(this).attr('template_id');

            $.ajax({
                url: '{{ base_url("admin/settings/getEmailNotificationContent") }}',
                type: "POST",
                data: {templateId: templateId, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                       
                        var aData = data.datarow;
                        $(".emailTitle").val(aData.notification_name);
                        $(".admin_sms_content").val(aData.admin_sms_content);
                        $(".client_sms_content").val(aData.client_sms_content);
                        $(".user_sms_content").val(aData.user_sms_content);
                       
                        $(".template_id").val(templateId);
                        $('.overlaynew').hide();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error() {
                    alertMessage('Error: Some thing wrong!');
                }
            });
            return false;
        });

        $(document).on('click', '.emailNotiSmartPopup', function() {
            $('.overlaynew').show();
           
            $(".emailNotificationShow").animate({
                width: "toggle"
            });
            var type = $(this).attr('type');
            var templateId = $(this).attr('template_id');
          
            $.ajax({
                url: '{{ base_url("admin/settings/getEmailNotificationContent") }}',
                type: "POST",
                data: {templateId: templateId,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                       
                        var aData = data.datarow;
                        $(".emailTitle").val(aData.notification_name);
                        $(".emailSubjectAdmin").val(aData.email_subject_admin);
                        $(".emailSubjectClient").val(aData.email_subject_client);
                        $(".emailSubjectUser").val(aData.email_subject_user);
                        $(".emailTextAdmin").summernote('code', aData.email_content_admin);
                        $(".emailTextClient").summernote('code', aData.email_content_client);
                        $(".emailTextUser").summernote('code', aData.email_content_user);
                        
                        $(".template_id").val(templateId);
                        $('.overlaynew').hide();

                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error() {
                    alertMessage('Error: Some thing wrong!');
                }
            });
            return false;
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

        $(document).on('submit', '#frmEditEmailTemplate', function (e) {
            
            var formdata = $("#frmEditEmailTemplate").serialize();
            $.ajax({
                url: '{{ base_url('admin/settings/updateEmailNotificationContent') }}',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        alert('Save successfully.');
                    }
                }
            });
            return false;
        });

        $(document).on('submit', '#frmEditSMSTemplate', function (e) {
            
            var formdata = $("#frmEditSMSTemplate").serialize();
            $.ajax({
                url: '{{ base_url('admin/settings/updateSMSNotificationContent') }}',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                      alert('Save successfully.');
                    }
                }
            });
            return false;
        });

        $(document).on('submit', '#frmEditSystemTemplate', function (e) {
            
            var formdata = $("#frmEditSystemTemplate").serialize();
            $.ajax({
                url: '{{ base_url('admin/settings/updateS3setting') }}',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                      alert('Save successfully.');
                      document.location='';
                    }
                }
            });
            return false;
        });

        $('.adminSubject').show();
        $('.emailTextAdmin').next().show();
        $('.clientSubject').hide();
        $('.emailTextClient').next().hide();
        $('.userSubject').hide();
        $('.emailTextUser').next().hide();

        $('.admin_sms_content').show();
        $('.client_sms_content').hide();
        $('.user_sms_content').hide();

        $('.admin_system_content').show();
        $('.client_system_content').hide();
        $('.user_system_content').hide();

        $(document).on('change', '.eventSMSType', function() {

            $('.overlaynew').show();
            var eventSMSType = $(this).val();
            if(eventSMSType == 'admin') {
                
                $('.admin_sms_content').show();
                $('.client_sms_content').hide();
                $('.user_sms_content').hide();

            } else if(eventSMSType == 'client') {

                $('.admin_sms_content').hide();
                $('.client_sms_content').show();
                $('.user_sms_content').hide();
                
            } else if(eventSMSType == 'user') {
                
                $('.admin_sms_content').hide();
                $('.client_sms_content').hide();
                $('.user_sms_content').show();
            }

            setTimeout(function() {
              $('.overlaynew').hide();
            }, 500);

        });

        $(document).on('change', '.eventSystemType', function() {

            $('.overlaynew').show();
            var eventSystemType = $(this).val();
            if(eventSystemType == 'admin') {
                
                $('.admin_system_content').show();
                $('.client_system_content').hide();
                $('.user_system_content').hide();

            } else if(eventSystemType == 'client') {

                $('.admin_system_content').hide();
                $('.client_system_content').show();
                $('.user_system_content').hide();
                
            } else if(eventSystemType == 'user') {
                
                $('.admin_system_content').hide();
                $('.client_system_content').hide();
                $('.user_system_content').show();
            }

            setTimeout(function() {
              $('.overlaynew').hide();
            }, 500);
        });


        $(document).on('change', '.eventEmailType', function() {

            $('.overlaynew').show();
            var eventEmailType = $(this).val();
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
            setTimeout(function() {
              $('.overlaynew').hide();
            }, 500);
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
                    url: "{{ base_url('admin/settings/sendTestEmailPreview') }}",
                    type: "POST",
                    data: {'addSysEmailAdmin':addSysEmailAdmin,_token: '{{csrf_token()}}','addSysEmailClient': addSysEmailClient, 'addSysEmailUser':addSysEmailUser, 'testEmailSys':testEmailSys, 'emailType':emailType, 'addSubEmailsubAdmin':addSubEmailsubAdmin, 'addSubEmailsubClient':addSubEmailsubClient, 'addSubEmailsubUser':addSubEmailsubUser, _token: '{{csrf_token()}}'},
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
@endsection 