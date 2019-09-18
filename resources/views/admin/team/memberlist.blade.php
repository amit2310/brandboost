@extends('layouts.main_template')

@section('title')
{{ $title }}
@endsection

@section('contents')

<!-- Content area -->
<div class="content">
        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3>Team Members</h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Contacts &nbsp; &nbsp; <span class="caret"></span>
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

                @if (!empty($oRoles))
                    <button id="addTeamMember" type="button" class="btn bl_cust_btn btn-default addTeamMember dark_btn ml20"><i class="icon-plus3"></i><span> &nbsp; Team Members</button>
                @endif
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->


    <!-- Dashboard content -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Marketing campaigns -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
						<h6 class="panel-title">{{ $oMembers->count() > 0 ? $oMembers->count() : '' }} Team Members</h6>
						<div class="heading-elements">
							<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
								<input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
								<div class="form-control-feedback">
									<i class="icon-search4"></i>
								</div>
							</div>&nbsp; &nbsp;

							<button type="button" class="btn btn-xs btn-default editTeamMemberButton"><i class="icon-pencil position-left"></i> Edit</button>
							<button id="deleteTeamMembers" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
						</div>
					</div>

                    <div class="panel-body p0">
						@if ($oMembers->isNotEmpty())
							<table class="table datatable-basic datatable-sorting">
								<thead>
									<tr>
										<th style="display: none;"></th>
										<th style="display: none;"></th>
										<th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
										<th class="col-md-3"><i class="icon-user"></i>Member Details</th>
										<th class="col-md-3"><i class="icon-display"></i>Phone</th>
										<th class="col-md-3"><i class="icon-display"></i>BB Phone</th>
										<th class="col-md-3"><i class="icon-calendar"></i>Created</th>
										<th class="col-md-2"><i class="icon-hash"></i>Role</th>
										<th class="col-md-1 align-center"><i class="fa fa-dot-circle-o"></i>Action</th>
									</tr>
								</thead>

								<tbody>
									@foreach ($oMembers as $oMember)
										<tr id="append-{{ $oMember->id }}" class="selectedClass">
											<td style="display: none;">{{ date('m/d/Y', strtotime($oMember->created)) }}</td>
											<td style="display: none;">{{ $oMember->id }}</td>
											<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows"  value="{{ $oMember->id }}" ><span class="custmo_checkmark"></span></label></td>
											<td>
												<div style="vertical-align: top!important;" class="media-left media-middle">
													<a href="#">
														<img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
													</a>
												</div>
												<div class="media-left">
													{{ $oMember->firstname . ' ' . $oMember->lastname }}
													<div class="text-muted text-size-small">{{ $oMember->email }}</div>
												</div>
											</td>

											<td>
												<div class="media-left">
													<div class="pt-5"><a href="#" class="text-default text-semibold">{{ $oMember->mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $oMember->mobile }}</a></div>
												</div>
											</td>

											 <td>
												<div class="media-left">
													<div class="pt-5"><a href="#" class="text-default text-semibold">{!! $oMember->bb_number == '' ? '<span style="color:#999999">BB Phone Unavailable</span>' : $oMember->bb_number !!}</a></div>
													<div class="text-muted text-size-small">Chat</div>
												</div>
											</td>

											<td>
												<div class="media-left">
													<div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', strtotime($oMember->created)) }}</a></div>
													<div class="text-muted text-size-small">{{ date('h:i A', strtotime($oMember->created)) }}</div>
												</div>
											</td>
											<td>
												<button class="btn btn-xs btn_white_table pr10"><i class="icon-primitive-dot txt_green"></i>{{ $oMember->role_name }}</button>
											</td>
											<td>
												<div class="tdropdown">
													<button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
													<ul class="dropdown-menu dropdown-menu-right width-200">
														<li><a href="{{ base_url("admin/team/viewLog/".$oMember->id) }}" target="_blank" member_id="{{ $oMember->id }}" class="viewActivity"><i class="icon-gear"></i> View Activity Log</a></li>
														<li><a href="javascript:void(0);" member_id="{{ $oMember->id }}" class="editTeamMember"><i class="icon-file-stats"></i> Edit</a></li>
														<li><a href="javascript:void(0);" member_id="{{ $oMember->id }}" class="deleteTeamMember"><i class="icon-file-text2"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
                        @else
                            <table class="table datatable-basic datatable-sorting">
                                <thead>
                                    <tr>
										<th style="display: none;"></th>
										<th style="display: none;"></th>
										<th class="col-md-3"><i class="icon-user"></i>Member Details</th>
										<th class="col-md-3"><i class="icon-display"></i>Phone</th>
										<th class="col-md-3"><i class="icon-display"></i>BB Phone</th>
										<th class="col-md-3"><i class="icon-calendar"></i>Created</th>
										<th class="col-md-2"><i class="icon-hash"></i>Role</th>
										<th class="col-md-1 align-center"><i class="fa fa-dot-circle-o"></i>Action</th>
                                    </tr>
                                </thead>
								<tbody>
									<tr>
										<td colspan="12">
											<div class="row">
												<div class="col-md-12">
													<div style="margin: 20px 0px 0;" class="text-center">
														<h5 class="mb-20">
															Looks Like You Don’t Have Any Team Member Yet <img src="/assets/images/smiley.png"> <br>
															Lets Add Team Member.
														</h5>
														<button id="addTeamMember" class="btn bl_cust_btn btn-default dark_btn ml20 mb40 addTeamMember" type="button"><i class="icon-plus3"></i> Add Team Member</button>
													</div>
												</div>
											</div>
										</td>
										<td style="display: none;"></td>
										<td style="display: none;"></td>
										<td style="display: none;"></td>
										<td style="display: none;"></td>
										<td style="display: none;"></td>
										<td style="display: none;"></td>
										<td style="display: none;"></td>
									</tr>
								</tbody>
							</table>
						@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /dashboard content -->
</div>
<!-- /content area -->

<div id="editTeamMemberModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmEditTeamMember" class="form-horizontal" name="frmEditTeamMember">
                @csrf
                <div class="modal-header">
                <input type="hidden" name="" id="oMember_bb_number" value="">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Team Member</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="edit_firstname" id="edit_firstname" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="edit_lastname" id="edit_lastname" class="form-control" value="" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="edit_email" id="edit_email" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="edit_phone" id="edit_phone" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">BB Phone</label>
                                <div class="">
                                    <input readonly="readonly" name="bb_phone" id="bb_phone" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <div class="">
                                    <select class="form-control" name="edit_gender" id="edit_gender">
                                        <option>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <div class="">
                                    <select class="form-control" name="edit_countryCode" id="edit_countryCode">
                                        <option value="">Select Country</option>
                                        @php
											$countriesList = \App\Models\Admin\CountryModel::getCountriesList();
											foreach ($countriesList as $countryName):
                                            @endphp
												<option value="{{ $countryName->country_code }}">{{ $countryName->name }}</option>
											@endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <div class="">
                                    <input name="edit_cityName" id="edit_cityName" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">State</label>
                                <div class="">
                                    <input name="edit_stateName" id="edit_stateName" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Zip Code</label>
                                <div class="">
                                    <input name="edit_zipCode" id="edit_zipCode" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Social Profile</label>
                                <div class="">
                                    <input name="edit_socialProfile" id="edit_socialProfile" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tags</label>
                                <div class="">
                                    <input name="edit_tags" id="edit_tags" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Select Role</label>
                                <div class="">
                                    <select class="form-control" name="edit_memberRole" id="edit_memberRole" required>
                                        <option value="">Select Role</option>
                                        @if (!empty($oRoles))
                                            @foreach ($oRoles as $oRole)
                                                <option value="{{ $oRole->id }}">{{ $oRole->role_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                        <div class="form-group">
                        <span class="display-inline-block pull-left fsize13">Show team member web chat?</span>
                        <span class="display-inline-block pull-right fsize13">
                        <label class="custom-form-switch pull-left">
                        <input class="field"  type="checkbox" name="edit_webchat_config" id="edit_webchat_config">
                        <span class="toggle blue"></span>
                        </label>
                        </span>
                        </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                        <div class="form-group">
                        <span class="display-inline-block pull-left fsize13">Show team member Sms chat?</span>
                        <span class="display-inline-block pull-right fsize13">
                        <label class="custom-form-switch pull-left">
                        <input class="field" type="checkbox" name="edit_smschat_config" id="edit_smschat_config">
                        <span class="toggle blue"></span>
                        </label>
                        </span>
                        </div>
                        </div>

						@if($oMembers[0]->bb_number == "")
                            <div class="col-md-12" style="margin-top: 10px;display: none;" id="edit_bb_number_section">
								<div class="form-group mb0">
									<span class="display-inline-block pull-left fsize13">Add team member brand boost phone number?</span>
									<span class="display-inline-block pull-right fsize13">
										<label class="custom-form-switch pull-left">
											<input class="field" type="checkbox" id="edit_bb_number">
											<span class="toggle blue"></span>
										</label>
									</span>
								</div>
                            <p>Note: if this option is enabled a new number will be assign to this team member otherwise he will contiune with the main account number</p>
                            </div>
                        @endif

                            <div class="col-md-12" style="margin-top: 10px;display: none;" id="edit_bb_area_code">
								<div class="form-group mb0">
									<span class="display-inline-block pull-left fsize13">Please enter area code to view available numbers</span>
									<span class="display-inline-block pull-right fsize13">
										<label class="pull-left">
											<input class="form-control" style="width: 100px; margin-bottom: 10px" type="text" id="edit_area_code" value="">
											<a id="edit_get_number" style="cursor: pointer;" href="javascript:void(0)">Get Numbers</a>
										</label>
									</span>
								</div>
                            </div>

                            <div class="col-md-12" style="margin-top: 10px;" id="edit_bb_area_code_listing"></div>
					</div>
                </div>
                <div class="modal-footer p40">
                    <input type="hidden" name="edit_member_id" id="edit_member_id" value="" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- addBrandboost -->
<div id="addTeamMemberModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" name="frmaddTeamMemberModal" class="form-horizontal" id="frmaddTeamMemberModal" action="javascript:void();">
                 @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Team Member</h5>
                </div>

                <div class="modal-body">
				    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="firstname" id="firstname" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="lastname" id="lastname" class="form-control" value="" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="email" id="email" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="phone" id="phone" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <div class="">
                                    <select class="form-control" name="gender" id="gender">
                                        <option>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <div class="">
                                    <select class="form-control" name="countryCode" id="countryCode">
                                        <option value="">Select Country</option>
                                        @php
                                        $countriesList = \App\Models\Admin\CountryModel::getCountriesList();
                                        foreach ($countriesList as $countryName) {
                                            @endphp
                                            <option value="{{ $countryName->country_code }}">{{ $countryName->name }}</option>
                                        @php } @endphp
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <div class="">
                                    <input name="cityName" id="cityName" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">State</label>
                                <div class="">
                                    <input name="stateName" id="stateName" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Zip Code</label>
                                <div class="">
                                    <input name="zipCode" id="zipCode" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Social Profile</label>
                                <div class="">
                                    <input name="socialProfile" id="socialProfile" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tags</label>
                                <div class="">
                                    <input name="tags" id="tags" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Select Role</label>
                                <div class="">
                                    <select class="form-control" name="memberRole" required>
                                        <option value="">Select Role</option>
                                        @if (!empty($oRoles))
                                            @foreach ($oRoles as $oRole)
                                                <option value="{{ $oRole->id }}">{{ $oRole->role_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px">
							<div class="form-group mb0">
								<span class="display-inline-block pull-left fsize13">Show team member web chat?</span>
                                <span class="display-inline-block pull-right fsize13">
                                    <label class="custom-form-switch pull-left">
                                        <input class="field" type="checkbox" name="webchat_config" id="webchat_config">
                                        <span class="toggle blue"></span>
                                    </label>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px">
							<div class="form-group mb0">
								<span class="display-inline-block pull-left fsize13">Show team member Sms chat?</span>
                                <span class="display-inline-block pull-right fsize13">
                                    <label class="custom-form-switch pull-left">
                                        <input class="field" type="checkbox" name="smschat_config" id="smschat_config">
                                        <span class="toggle blue"></span>
                                    </label>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px;display: none;" id="bb_number_section">
							<div class="form-group mb0">
								<span class="display-inline-block pull-left fsize13">Add team member brand boost phone number?</span>
                                <span class="display-inline-block pull-right fsize13">
                                    <label class="custom-form-switch pull-left">
                                        <input class="field" type="checkbox" id="bb_number">
                                        <span class="toggle blue"></span>
                                    </label>
                                </span>
                            </div>
                            <p>Note: if this option is enabled a new number will be assign to this team member otherwise he will contiune with the main account number</p>
                        </div>


                        <div class="col-md-12" style="margin-top: 10px;display: none;" id="bb_area_code">
							<div class="form-group mb0">
								<span class="display-inline-block pull-left fsize13">Please enter area code to view available numbers</span>
                                <span class="display-inline-block pull-right fsize13">
                                    <label class="pull-left">
                                        <input class="form-control" style="width: 100px; margin-bottom: 10px" type="text" id="area_code" value="">
                                        <a id="get_number" style="cursor: pointer;" href="javascript:void(0)">Get Numbers</a>
                                    </label>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px;" id="bb_area_code_listing"></div>
                    </div>
                </div>

                <div class="modal-footer p40">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /addBrandboost -->

<script type="text/javascript">

    $(document).ready(function () {
// add ########################################
        $('body').on('click', '#get_number', function(e){
			$('#bb_area_code_listing').html(' <figure style="margin:15px 0;"><img style="width:16px!important; height:11px!important" id="theImg" src="{{ base_url() }}assets/images/ajax-loader.gif" /> </figure>');
		   $.ajax({
				url: "{{ base_url('admin/team/twilioNumberlisting') }}",
				type: "POST",
				data: {area_code : $('#area_code').val(),_token: '{{csrf_token()}}'},
				dataType: "html",
				success: function (data) {
					setTimeout(function(){
						$('#bb_area_code_listing').html(data);
					}, 4000);
				}
			});
		});

        $('#smschat_config').change(function () {

          if ($(this).prop("checked") == false) {
            $('#bb_area_code').hide();
            $('#bb_number_section').hide();
          }
          else
          {
             $('#bb_number_section').show();
          }
            });
             $('#bb_number').change(function () {

          if ($(this).prop("checked") == false) {
            $('#bb_area_code').hide();
            $('#bb_area_code_listing').hide();
          }
          else
          {
             $('#bb_area_code').show();
               $('#bb_area_code_listing').show();
          }
            });
             // add ########################################

// edit ########################################


		$('body').on('click', '#edit_get_number', function(e){
			$('#edit_bb_area_code_listing').html(' <figure style="margin:15px 0;"><img style="width:16px!important; height:11px!important" id="theImg" src="{{ base_url() }}assets/images/ajax-loader.gif" /> </figure>');
			$.ajax({
				url: '{{ base_url('admin/team/twilioNumberlisting') }}',
				type: "POST",
				data: {area_code : $('#edit_area_code').val(),_token: '{{csrf_token()}}'},
				dataType: "html",
				success: function (data) {
					setTimeout(function(){
						$('#edit_bb_area_code_listing').html(data);
					}, 4000);
				}
			});
		});

        $('#edit_smschat_config').change(function () {

          if ($(this).prop("checked") == false) {
            $('#edit_bb_area_code').hide();
            $('#edit_bb_number_section').hide();
          }
          else
          {
             if($('#oMember_bb_number').val() =="")
             {
              $('#edit_bb_number_section').show();
             }

          }
            });


             $('#edit_bb_number').change(function () {

          if ($(this).prop("checked") == false) {
            $('#edit_bb_area_code').hide();
            $('#edit_bb_area_code_listing').hide();
          }
          else
          {
             $('#edit_bb_area_code').show();
               $('#edit_bb_area_code_listing').show();
          }
            });

// edit ########################################

        $('.addTeamMember').click(function () {
            $('#addTeamMemberModal').modal();
        });

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

		$(document).on('click', '#deleteTeamMembers', function () {

			var val = [];
			$('.checkRows:checkbox:checked').each(function (i) {
				val[i] = $(this).val();
			});
			if (val.length === 0) {
				alert('Please select a row.')
			} else {
				swal({
					title: "Are you sure? You want to delete this record!",
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
						$.ajax({
							url: "{{ base_url('admin/team/deleteTeamMembers') }}",
							type: "POST",
							data: {multipal_id : val, _token: '{{csrf_token()}}'},
							dataType: "json",
							success: function (data) {
								if(data.status == 'success') {
									window.location.href = window.location.href
								}else {
									alertMessage('Error: Some thing wrong!');
									$('.overlaynew').hide();
								}
							}
						});
					}
				});
			}
		});

        $('#frmaddTeamMemberModal').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmaddTeamMemberModal").serialize();
            $.ajax({
                url: "{{ base_url('admin/team/addTeamMember') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '';
                    } else if (data.status == 'error') {
                        $('.overlaynew').hide();
                        $("#addMemberValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#addMemberValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });


        $(document).on("click", ".editTeamMember", function () {
            $('.overlaynew').show();
            var memberID = $(this).attr('member_id');
            $.ajax({
                url: "{{ base_url('admin/team/getTeamMember') }}",
                type: "POST",
                data: {'member_id': memberID, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
					$('.overlaynew').hide();
                    if (data.status == 'success') {
						var resultData = data.result;
                        //console.log(resultData);
                        $("#edit_firstname").val(resultData.firstname);
                        $("#edit_lastname").val(resultData.lastname);
                        $("#edit_email").val(resultData.email);
                        $("#edit_phone").val(resultData.mobile);
                        $("#edit_memberRole").val(resultData.team_role_id);
                        $("#edit_member_id").val(resultData.id);
                        $('#edit_gender').val(resultData.gender);
                        $('#edit_countryCode').val(resultData.country);
                        $('#edit_cityName').val(resultData.city);
                        $('#edit_stateName').val(resultData.state);
                        $('#edit_zipCode').val(resultData.zip_code);
                        $('#edit_socialProfile').val(resultData.socialProfile);
                        $('#edit_tags').val(resultData.tagID);
                        $('#oMember_bb_number').val(resultData.bb_number);
                        $('#bb_phone').val(resultData.bb_number);
                        if(resultData.web_chat == '1')
                        {
                            $("#edit_webchat_config").prop('checked', true);
                        }
                        else
                        {
                            $("#edit_webchat_config").prop('checked', false);
                        }
                        if(resultData.sms_chat == '1')
                        {
                            $("#edit_smschat_config").prop('checked', true);
                            if($('#oMember_bb_number').val() == "")
                            {
                                $('#edit_bb_number_section').show();
                            }
                        }
                        else
                        {
                             $("#edit_smschat_config").prop('checked', false);
                        }

                        $("#editTeamMemberModel").modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error(){
					$('.overlaynew').hide();
				}
            });
        });


		$('#frmEditTeamMember').on('submit', function () {
			var formdata = $("#frmEditTeamMember").serialize();
			$.ajax({
				url: "{{ base_url('admin/team/updateTeamMember') }}",
				type: "POST",
				data: formdata,
				dataType: "json",
				success: function (data) {
					$('.overlaynew').hide();
					if (data.status == 'success') {
						window.location.href = '';
					} else {
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
			return false;
		});


		$(document).on('click', '.deleteTeamMember', function () {
			var elem = $(this);
			deleteConfirmationPopup(
			"This record will deleted immediately.<br>You can't undo this action.",
			function() {
				$('.overlaynew').show();
				var memberID = $(elem).attr('member_id');
				$.ajax({
					url: "{{ base_url('admin/team/deleteTeamMember') }}",
					type: "POST",
					data: {member_id: memberID,_token: '{{csrf_token()}}'},
					dataType: "json",
					success: function (data) {
						$('.overlaynew').hide();
						if (data.status == 'success') {
							window.location.href = window.location.href;
						} else {
							alertMessage('Error: Some thing wrong!');
						}
					}
				});
			});
		});

		$(document).on('click', '.editTeamMemberButton', function () {
			$('.editAction').toggle();
		});
	});
</script>
@endsection
