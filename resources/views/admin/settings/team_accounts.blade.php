@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
	<div class="content">   
	<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header">
	  <div class="row">
	  <!--=============Headings & Tabs menu==============-->
		<div class="col-md-5">
			<h3 class=""><img  width="20"  src="/assets/images/menu_icons/Website_Light.svg"/>Twillo Log</h3>
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
				  <h6 class="panel-title">Twillo Log</h6>
				  </span>
				  
				  <div class="heading-elements">
					<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
						<input class="form-control input-sm cus_search" tableid="twilloLog" placeholder="Search by name" type="text">
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
					<table class="table" id="twilloLog">
						<thead>
							<tr>
								<th style="display:none;"></th>
								<th style="display:none;"></th>
								<th>Account Name</th>
								<th>Account Email</th>
								<th>Twillo Number</th>
								<th>Total Cost</th>
								<th>View Details</th>
							</tr>
						</thead>
						<tbody>
							<!--========== ROW START =============-->
							@php 
							if(!empty($twillo_account_detail)) {
								$teamMemArr = array();
								foreach($twillo_account_detail as $detail) {
									$getUsage = \App\Models\Admin\SettingsModel::getUsageSingleNumber($detail->bb_number);
									
							@endphp
							<tr>
								<td style="display:none;"></td>
								<td style="display:none;">{{ $detail->id }}</td>
								<td>{{ $detail->firstname.' '.$detail->lastname }}</td>
								<td>{{ $detail->email }}</td>
								<td>{{ $detail->bb_number }}</td>
								<td>{{ '$'.$getUsage }}</td>
								<td>
									<div class="tdropdown"> 
										<a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="/assets/images/more.svg"></a>
										<ul class="dropdown-menu dropdown-menu-right more_act">
											<a href="#" class="dropdown_close">X</a>
											<li><a href="{{ base_url('admin/settings/list_details/' . $detail->id) }}" user_id="35" class="systemNotiSmartPopup"><i class="icon-arrow-down16"></i>View Nmumber Details</a> </li>
										</ul>
									</div>
								</td>
							</tr>
							@php 
								}
							} 
							@endphp
						</tbody>
					</table>
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
		var tableId = 'twilloLog';
		var tableBase = custom_data_table(tableId, '1', 'asc');
    });
</script>
@endsection 