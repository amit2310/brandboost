<div class="tab-pane @if (empty($seletedTab)) active @endif" id="right-icon-tab0">
    <div class="row">
        <div class="col-md-12">
            <div style="margin: 0;" class="panel panel-flat">
                <div class="panel-heading"> <span class="pull-left">
                        <h6 class="panel-title">{{ count($oCrValues) }} Credit Properties</h6>
                    </span>
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
                                <th><i class="icon-user"></i> Property Name</th>
                                <th><i class="icon-user"></i> Property Key</th>
                                <th class="text-center"><i class="icon-user"></i> Credit</th>
                                <th><i class="icon-calendar"></i>Last Updated</th>
                                <th><i class="icon-calendar"></i> Created</th>
                                <th class="text-center"><i class="icon-user"></i> Status</th>
                                <th class="text-center"><i class="fa fa-dot-circle-o"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!--=======================-->
                            @foreach ($oCrValues as $oCr)
                                <tr>
                                    <td style="display:none;"></td>
                                    <td style="display:none;"></td>
                                    <td>
                                        {{ $oCr->feature_name }}
                                    </td>
                                    
                                    <td>
                                        {{ $oCr->feature_key }}
                                    </td>

                                    <td class="text-center">
                                        {{ $oCr->credit_value }}
                                    </td>

                                    <td>
                                        <div class="media-left">
                                            <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', strtotime($oCr->updated)) }}</a></div>
                                            <div class="text-muted text-size-small">{{ date('h:i A', strtotime($oCr->updated)) }}</div>
                                        </div>

                                    </td>
                                    
                                    <td>
                                        <div class="media-left">
                                            <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', strtotime($oCr->created)) }}</a></div>
                                            <div class="text-muted text-size-small">{{ date('h:i A', strtotime($oCr->created)) }}</div>
                                        </div>

                                    </td>
                                    
                                    <td class="text-center">
                                        @if($oCr->status == true)
											<button class="btn btn-xs btn_white_table whitt dropdown-toggle" data-toggle="dropdown"><i class="icon-primitive-dot txt_green"></i> Active</button>
                                        @else
											<button class="btn btn-xs btn_white_table whitt dropdown-toggle" data-toggle="dropdown"><i class="icon-primitive-dot txt_grey"></i> Disabled</button>
                                        @endif
                                    </td>

                                   <td style="text-align: center;">
                                        <a class="btn green_cust_btn editCrditProperties"  credit_id="{{ base64_url_encode($oCr->id) }}"><i class="fa fa-eye"></i></a>
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

<div id="addEmailNotificationTemplate" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddEmailTemplate" id="frmAddEmailTemplate" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Email Notification Template</h5>
                </div>

                <div class="modal-body">
                    <p>Title:
                        <input class="form-control" name="title" placeholder="Enter Title for the notification" type="text" required></p>

                    <p>Subject:
                        <input class="form-control" name="subject" placeholder="Enter Subject" type="text" required></p>

                    <p>Event Name:
                        <input class="form-control" name="template_tag" placeholder="Enter Event Name" type="text" required></p>
                    <p>Plain Text:
                        <textarea class="form-control" name="plain_text" id="sys_plain_text" rows="6" placeholder="Enter Plain Text" required=""></textarea>
                        <br>
                        <button type="button" data-toggle="tooltip" title="" data-tag-name="{FIRST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{FIRST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{LAST_NAME}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{LAST_NAME}</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" title="" data-tag-name="{EMAIL}" class="btn btn-default add_btn draggable insert_tag_button" data-original-title="Click to insert Tag">{EMAIL}</button>&nbsp;&nbsp;
                    </p>

                    <p>Email Type
                        <input type="radio" id="notify-plain-text" name="content_type" value="plain" style="margin-left:10px;" checked="checked" /> <label for="notify-plain-text">Plain</label>
                        <input type="radio" id="notify-html-text" name="content_type" value="html" style="margin-left:10px;"  /> <label for="notify-html-text">Html</label>

                    </p> 

                    <p>Send SMS Too
                        <label class="custom-form-switch">
                            <input type="checkbox" name="send_sms" id="sys_send_sms" class="field checkedBoxValue">
                            <span class="toggle"></span>
                        </label>
                    </p> 

                </div>

                <div class="modal-footer p40">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editCreditProperty" class="modal fade">
    <div style="max-width: 760px;" class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmCreditProperty" id="frmCreditProperty" action="javascript:void();">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Edit Credit Property</h5>
                </div>
                <div class="modal-body">
                    <p>Property Key:
                        <input class="form-control" id="edit_property_key" readonly="readonly" type="text" style="background:#CCCCCC;"></p>
                    
                    <p>Property Name:
                        <input class="form-control" name="title" id="edit_property_title" placeholder="Enter Title for the credit property" type="text" required></p>

                    <p>Credits:
                        <input class="form-control" name="feature_credits" id="edit_feature_credits" placeholder="Enter Credit Value" type="text" required></p>
                </div>
                <div class="modal-footer p40">
                    <input type="hidden" name="creditID" id="edit_credit_property_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#frmAddEmailTemplate').on('submit', function (e) {
            var formdata = $("#frmAddEmailTemplate").serialize();
            $.ajax({
                url: "{{ base_url('admin/settings/saveEmailNotificationTemplate') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //Display tag list
                        window.location.href = '{{ base_url() }}admin/settings/setup_system_notifications?t=email';
                    }
                }
            });
            return false;
        });


        $(document).on("click", ".editCrditProperties", function (e) {
            var creditID = $(this).attr('credit_id');
            $.ajax({
                url: '{{ base_url("admin/settings/getCreditPropery") }}',
                type: "POST",
                data: {creditID: creditID,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#edit_property_key").val(data.datarow.feature_key);
                        $("#edit_property_title").val(data.datarow.feature_name);
                        $('#edit_feature_credits').val(data.datarow.credit_value);
                        $('#edit_credit_property_id').val(creditID);
                        $('#editCreditProperty').modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error() {
                    alertMessage('Error: Some thing wrong!');
                }
            });

            return false;

        });

        $('#frmCreditProperty').on('submit', function (e) {
            var formdata = $("#frmCreditProperty").serialize();
            $.ajax({
                url: "{{ base_url('admin/settings/updateCreditPropery') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '{{ base_url() }}admin/settings/creditValues';
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
								window.location.href = '{{ base_url() }}admin/settings/setup_system_notifications?t=email';
							}
						}
					});
				}
			});
        });
    });
</script>