@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')

@php
	$iActiveCount = $iArchiveCount = 0;
	
	if (!empty($oWidgetsList)) {
		foreach ($oWidgetsList as $oCount) {
			if ($oCount->status == 3) {
				$iArchiveCount++;
				} else {
				$iActiveCount++;
			}
		}
	}
@endphp

<!-- Content area -->
<div class="content">
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><i class="icon-star-half"></i> Referral Widgets</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
					<li class="active"><a style="javascript:void();" id="activeWidget" class="filterByColumn" fil="publish">Active Widgets</a></li>
                    <li><a style="javascript:void();" class="filterByColumn" fil="archive">Archive</a></li>
				</ul>
			</div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Referral Widget &nbsp; &nbsp; <span class="caret"></span>
					</button>
                    <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                        <div class="dropdown-content-heading"> Filter
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-more"></i></a> </li>
							</ul>
						</div>
                        <div class="">
                            <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings active">
                                        <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
									</div>
                                    <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
												</div>
											</div>
										</div>
									</div>
								</div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
									</div>
                                    <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
											</div>
										</div>
									</div>
								</div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
									</div>
                                    <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
											</div>
										</div>
									</div>
								</div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
									</div>
                                    <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
											</div>
										</div>
									</div>
								</div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
									</div>
                                    <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Total Reviews
														</label>
													</div>
												</div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
												</div>
												
											</div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Positive
														</label>
													</div>
												</div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
												</div>
												
											</div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary">
                                                            Neutral
														</label>
													</div>
												</div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
												</div>
												
											</div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Negative
														</label>
													</div>
												</div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <div class="dropdown-content-footer">
                            <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                            &nbsp; &nbsp;
                            <a style="display: inline-block;" href="#">Clear All</a>
						</div>
					</div>
				</div>
				
				<button id="addReferralWidget" class="btn bl_cust_btn btn-default dark_btn ml20" type="button"><i class="icon-plus3"></i> Add Referral Widget</button>
			</div>
		</div>
	</div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
	
	
    <div class="tab-content">
		<!--===========TAB 1===========-->
		<div class="tab-pane active" id="right-icon-tab0">
			<div class="row">
				<div class="col-lg-12">
					<!-- Marketing campaigns -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title"><?php //echo $iActiveCount; ?> Referral Widgets</h6>
							<div class="heading-elements">
								
								<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
									<input class="form-control input-sm cus_search" tableId="referralWidgetList" placeholder="Search by name" type="text">
									<div class="form-control-feedback">
										<i class="icon-search4"></i>
									</div>
								</div>
								<div class="table_action_tool">
									<a href="javascript:void(0)"><i class="icon-calendar52"></i></a>
									<a href="javascript:void(0)" class="editDataList"><i class="icon-pencil"></i></a>
									<button id="deleteReferralWidget" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
									<button id="archiveButtonReferralWidget" class="btn btn-xs custom_action_box"><i class="icon-gear position-left"></i> Archive</button>
								</div>
								
							</div>
						</div>
						
						<div class="panel-body p0">
							@if(!empty($oWidgetsList))
							<table class="table" id="referralWidgetList">
								<thead>
									<tr>
										<th style="display: none;"></th>
										<th style="display: none;"></th>
										<th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
										<th><i class="icon-stack-star"></i>Referral Widget Title</th>
										<th><i class="icon-stack-star"></i>Referral App Name</th>
										<th><i class="icon-calendar"></i>Created</th>
										<th><i class="fa fa-dot-circle-o"></i>Status</th>
										<th><i class="fa fa-dot-circle-o"></i>Action</th>
										<th table-column="status" style="display: none;"><i class="fa fa-dot-circle-o"></i>status</th>
									</tr>
								</thead>
								
								<tbody>
									@php
                                        $aUser = getLoggedUser();
                                        $currentUserId = $aUser->id;
										
                                        foreach ($oWidgetsList as $data) {
                                            $referralData = \App\Models\Admin\Modules\ReferralModel::getReferral($currentUserId, $data->referral_id);
											
										@endphp
										
										<tr id="append-{{ $data->id }}" class="selectedClass">
											<td style="display: none;">{{ date('m/d/Y', strtotime($data->created)) }}</td>
											<td style="display: none;">{{ $data->id }}</td>
											<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk{{ $data->id }}" value="{{ $data->id }}" ><span class="custmo_checkmark"></span></label></td>
											<td>
												<div class="media-left media-middle">
													<a href="{{ base_url('admin/modules/referral/referral_widget_setup/' . $data->id) }}" widgetID="{{ $data->id }}" b_title="{{ $data->widget_title }}" class="text-default text-semibold">
													<img src="{{ base_url('assets/images/default_table_img2.png') }}" class="img-circle img-xs br5" alt="Img"></a>
												</div>
												<div class="media-left">
													<div class=""><a href="{{ base_url('admin/modules/referral/referral_widget_setup/' . $data->id) }}" widgetID="{{ $data->id }}" b_title="{{ $data->widget_title }}" class="text-default text-semibold">{{ $data->widget_title }}</a></div>
													<div class="text-muted text-size-small">
													{{ setStringLimit($data->widget_desc) }}
													</div>
												</div>
											</td>
											
											<td>
												@if ($data->referral_id == '' || $data->referral_id == 0)
												<div class="media-left media-middle">
													<span class="icons fl_letters_gray s28">NA</span>
												</div>
												<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>
												@else
												<div class="media-left media-middle">
													<a class="icons square">
														<i class="icon-checkmark3 txt_blue"></i>
													</a>
												</div>
												<div class="media-left">
													<a href="{{ base_url("admin/modules/referral/setup/" . $data->referral_id) }}" target="_blank">
														@php if(!empty($referralData)){ echo $referralData->title; } @endphp
													</a>
												</div>
												@endif
											</td>
											
											<td>
												<div class="media-left">
													<div class="pt-5"><span class="text-default text-semibold">{{ dataFormat($data->created) }}</span></div>
													<div class="text-muted text-size-small">{{ date('h:i A', strtotime($data->created)) }}</div>
												</div>
											</td>
											
											<td>
												<button class="btn btn-xs btn_white_table pr10">
													@php
														if ($data->status == 1) {
															echo '<i class="icon-primitive-dot txt_green"></i> Publish';
                                                            } else if ($data->status == 2) {
															echo '<i class="icon-primitive-dot txt_red"></i> Pause';
                                                            } else if ($data->status == 3) {
															echo '<i class="icon-primitive-dot txt_red"></i> Archive';
                                                            } else {
															echo '<i class="icon-primitive-dot txt_red"></i> Draft';
														}
													@endphp
												</button>
											</td>
											
											<td>
												@php
													if ($user_role != '2') {
														if ($currentUserId == $data->user_id || $user_role == 1) {
														@endphp
														
														<div class="tdropdown">
															<button type="button" class="btn btn-xs plus_icon ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
															<ul class="dropdown-menu dropdown-menu-right width-200">
																@if ($data->status == 1)
																	<li><a href="javascript:void(0);" class="changeStatusCampaign" widgetID="{{ $data->id }}" status="2"><i class="icon-file-stats"></i> Pause</a></li>
																@endif
																@if ($data->status == 2)
																	<li><a href="javascript:void(0);" class="changeStatusCampaign" widgetID="{{ $data->id }}" status="1"><i class="icon-file-stats"></i> Start</a></li>
																@endif
																<li><a href="{{ base_url('admin/modules/referral/referral_widget_setup/' . $data->id) }}" widgetID="{{ $data->id }}" b_title="{{ $data->widget_title }}" class="text-default text-semibold"><i class="icon-pencil"></i>  Edit</a></li>
																
																<li><a href="javascript:void(0);" class="deleteCampaign" widgetID="{{$data->id }}"><i class="icon-trash"></i> Delete</a></li>
																<li><a href="javascript:void(0);" class="changeStatusCampaign" widgetID="{{ $data->id }}" status="3"><i class="icon-file-text2"></i> Move to Archive</a></li>
																
																<li><a href="javascript:void(0);" class="viewECode" widgetID="{{ $data->id }}"><i class="icon-file-locked"></i> Get Embedded Code</a></li>
																
															</ul>
														</div>
														@php
                                                            } else {
															echo '-';
														}
													}
												@endphp
											</td>
											
											<td style="display: none;">{{ $data->status == 3 ? 'Archive' : 'Publish' }}</td>
										</tr>
										@php
										}
									@endphp
								</tbody>
							</table>
							@else
								<table class="table datatable-basic">
                                    <thead>
                                        <tr>
                                            <th style="display: none"></th>
                                            <th style="display: none"></th>
                                            <th><i class="icon-stack-star"></i>Referral Widget Title</th>
											<th><i class="icon-stack-star"></i>Referral App Name</th>
											<th><i class="icon-calendar"></i>Created</th>
											<th><i class="fa fa-dot-circle-o"></i>Status</th>
											<th><i class="fa fa-dot-circle-o"></i>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td colspan="10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div style="margin: 20px 0px 0;" class="text-center">
                                                        <h5 class="mb-20 mt40">
                                                            Looks Like You Don’t Have Any Referral Widget Yet <img src="{{ site_url('assets/images/smiley.png') }}"> <br>
                                                            Lets Create Your First Referral Widget.
                                                        </h5>

                                                        <?php //if ($canWrite): ?>
                                                            <button @if ($bActiveSubsription == false) title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription mb40" @else id="addReferralWidgetShow" class="btn bl_cust_btn btn-default dark_btn ml20 mb40" @endif type="button" ><i class="icon-plus3"></i> Add Referral Widget</button>
                                                        <?php //endif; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                    </tbody>
                                </table>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>            
	
	
    <!-- /dashboard content -->
	
</div>
<!-- /content area -->

<div id="viewEModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Embedded Widget Code</h5>
			</div>
            <div class="modal-body">
                <div id="embeddedCode" style="border:1px #ccc solid; padding:20px; margin:10px 0 0;"></div>
			</div>
			           
            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
			</div>
		</div>
	</div>
</div>



<div id="addReferralWidgetModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddReferralWidget" id="frmAddReferralWidget" action="javascript:void();">
				@csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Referral Widget</h5>
				</div>
				
                <div class="modal-body">
                    <p>Please Enter Title below:</p>
                    <input class="form-control" id="referralTitle" name="referralTitle" placeholder="Enter Title" type="text" required>
				</div>
				
                <div class="modal-footer p40">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Continue</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	
    $(document).ready(function () {
		setTimeout(function () {
			$('#activeWidget').trigger('click');
		}, 200);
	   
		var tableId = 'referralWidgetList';
		var tableBase = custom_data_table(tableId); 
		
		// Setup - add a text input to each footer cell
		
		$('#referralWidgetList thead tr').clone(true).appendTo('#referralWidgetList thead');        
		$('#referralWidgetList thead tr:eq(1) th').each(function (i) {  
			var tableColumn = $(this).attr('table-column');
			if (tableColumn === 'status') {
				var title = $(this).text();
				$(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" />');                
				$('input', this).on('keyup change', function () {
					if (tableBase.column(i).search() !== this.value) {
						tableBase.column(i).search(this.value, $('#colStatus').prop('checked', true)).draw();
					}
				});
			}
		});
		
		
		$(document).on('click', '.filterByColumn', function () {            
			$('.nav-tabs').each(function (i) {
				$(this).children().removeClass('active');
			});

			$(this).parent().addClass('active');
			var fil = $(this).attr('fil');
			$('#filterByStatus').val(fil);
			$('#filterByStatus').keyup();        
		});
		       
		$('table thead tr:eq(1)').hide();
		
		   
        $('#checkAll').change(function () {
			
            if (false == $(this).prop("checked")) {
				
                $(".checkRows").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box').hide();
				} else {
				
                $(".checkRows").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box').show();
			}
			
		});
		
        $(document).on('click', '.checkRows', function () {
            var inc = 0;
			
			
            var rowId = $(this).val();
			
            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
				} else {
                $('#append-' + rowId).addClass('success');
			}
			
            $('.checkRows:checkbox:checked').each(function (i) {
                inc++;
			});
            if (inc == 0) {
				
                $('.custom_action_box').hide();
				} else {
                $('.custom_action_box').show();
			}
			
            var numberOfChecked = $('.checkRows:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll').prop('checked', false);
			}
			
		});
		
        $(document).on('click', '#deleteReferralWidget', function () {
			
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
			});
            if (val.length === 0) {
                alert('Please select a row.')
			} else {
				
                deleteConfirmationPopup(
				"Are you sure? You want to delete these records.<br>You can't undo this action.", 
				function() {
					$('.overlaynew').show();
					$.ajax({
						url: "{{ base_url('admin/modules/referral/deleteBulkReferralWidgets') }}",
						type: "POST",
						data: {multi_widget_id: val, _token: '{{csrf_token()}}'},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = '';
							}
						}
					});
				});
			}
		});
		
		$(document).on('click', '#archiveButtonReferralWidget', function () {
			
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
			});
            if (val.length === 0) {
                alert('Please select a row.')
			} else {
				
                archiveConfirmationPopup(
				"", 
				function() {
					$('.overlaynew').show();
					$.ajax({
						url: "{{ base_url('admin/modules/referral/archiveBulkReferralWidgets') }}",
						type: "POST",
						data: {multi_widget_id: val, _token: '{{csrf_token()}}'},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = '';
							}
						}
					});
				});
			}
		});
		
        $('#checkAllA').change(function () {
			
            if (false == $(this).prop("checked")) {
				
                $(".checkRowsA").prop('checked', false);
                $(".selectedClassA").removeClass('success');
                $('.custom_action_boxA').hide();
				} else {
				
                $(".checkRowsA").prop('checked', true);
                $(".selectedClassA").addClass('success');
                $('.custom_action_boxA').show();
			}
			
		});
		
        $(document).on('click', '.checkRowsA', function () {
            var inc = 0;
			
			
            var rowId = $(this).val();
			
            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
				} else {
                $('#append-' + rowId).addClass('success');
			}
			
            $('.checkRowsA:checkbox:checked').each(function (i) {
                inc++;
			});
            if (inc == 0) {
				
                $('.custom_action_boxA').hide();
				} else {
                $('.custom_action_boxA').show();
			}
			
            var numberOfChecked = $('.checkRowsA:checkbox:checked').length;
            var totalCheckboxes = $('.checkRowsA:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAllA').prop('checked', false);
			}
			
		});
		
		$(document).on('click', '#addReferralWidgetShow', function() {
			$('#addReferralWidget').trigger('click');
		});
		
        $('#addReferralWidget').click(function () {
            $('#addReferralWidgetModal').modal();
		});
		
        $('#frmAddReferralWidget').on('submit', function (e) {
            $('.overlaynew').show();
            var referralTitle = $('#referralTitle').val();
            $.ajax({
                url: "{{ base_url('admin/modules/referral/addReferralWidget') }}",
                type: "POST",
                data: {'referralTitle': referralTitle, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = "{{ base_url() }}admin/modules/referral/referral_widget_setup/' + data.widgetId;
						} else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});
		
		
        $(document).on("click", ".changeStatusCampaign", function () {
            var widgetID = $(this).attr('widgetID');
            var status = $(this).attr('status');
            $.ajax({
                url: "{{ base_url('admin/modules/referral/updatReferralWidgetStatus') }}",
                type: "POST",
                data: {'widgetID': widgetID, 'status': status, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = "{{ base_url('admin/modules/referral/widgets') }}";
						} else {
                        alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});
		
		$(document).on('click', '.deleteCampaign', function () {
			var elem = $(this);
            deleteConfirmationPopup(
            "This record will deleted immediately.<br>You can't undo this action.", 
            function() {
				$('.overlaynew').show();
				var widgetID = $(elem).attr('widgetID');
				$.ajax({
					url: "{{ base_url('admin/modules/referral/delete_referral_widget') }}",
					type: "POST",
					data: {widget_id: widgetID, _token: '{{csrf_token()}}'},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
							$('.overlaynew').hide();
							window.location.href = '';
						}
					}
				});
			});
		});
		
        $(document).on('click', '.viewECode', function () {
            var widgetID = $(this).attr('widgetID');
            $.ajax({
                url: "{{ base_url('admin/modules/referral/getReferralWidgetEmbedCode') }}",
                type: "POST",
                data: {widget_id: widgetID, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var embeddedCode = data.result;
                        $('#embeddedCode').html(embeddedCode);
                        $("#viewEModel").modal();
					}
				}
			});
		});
		
        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
		});
		
        $('[data-toggle="tooltip"]').tooltip();
	});
</script>
@endsection
