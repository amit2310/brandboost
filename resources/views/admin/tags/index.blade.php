@extends('layouts.main_template')

@section('title')
    {{ $title }}
@endsection

@section('contents')

    @php
        list($canRead, $canWrite) = fetchPermissions('Tags')
    @endphp

    @php
        if (!empty($aTag)) {
            foreach ($aTag as $aUnit) {
                $aGroupID[$aUnit->id]['group_name'] = $aUnit->group_name;
                $aGroupID[$aUnit->id]['status'] = $aUnit->status;
                $aGroupID[$aUnit->id]['id'] = $aUnit->id;
            }
        }
    @endphp

    <div class="content">
        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-5">
                    <h3><i class="icon-vcard"></i> &nbsp; Tags Group</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Active Tags Group</a></li>
                        <li><a href="#right-icon-tab1" data-toggle="tab">Archive</a></li>
                    </ul>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-7 text-right btn_area">
                    <div class="btn-group">
                        <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Contacts &nbsp; &nbsp; <span
                                class="caret"></span>
                        </button>
                        <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                            <div class="dropdown-content-heading"> Filter
                                <ul class="icons-list">
                                    <li><a href="#"><i class="icon-more"></i></a></li>
                                </ul>
                            </div>
                            <div class="">
                                <div
                                    class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign"
                                    id="accordion-control-right">
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings active">
                                            <h6 class="panel-title"><a data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group1"><i
                                                        class="icon-star-empty3"></i>&nbsp;Campaign Type</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Most startups fail. But many of those failures are preventable.
                                                        The Lean Startup is a new approach being adopted across the
                                                        globe, changing the way companies are built and new products are
                                                        launched.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group2"><i
                                                        class="icon-arrow-up-left2"></i>&nbsp; Source</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group73"><i
                                                        class="icon-star-full2"></i>&nbsp; Rating</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group74"><i
                                                        class="icon-calendar"></i>&nbsp; Date Created</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group83"><i
                                                        class="icon-thumbs-up2"></i>&nbsp; Reviews</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary"
                                                                       checked="checked">
                                                                Total Reviews
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="20"/> <span class="dash">-</span> <input
                                                            class="form-control input-sm" type="text" name=""
                                                            value="100"/>
                                                    </div>

                                                </div>
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary"
                                                                       checked="checked">
                                                                Positive
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="20"/> <span class="dash">-</span> <input
                                                            class="form-control input-sm" type="text" name=""
                                                            value="100"/>
                                                    </div>

                                                </div>
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary">
                                                                Neutral
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="20" disabled/> <span class="dash">-</span> <input
                                                            class="form-control input-sm" type="text" name=""
                                                            value="100" disabled/>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary"
                                                                       checked="checked">
                                                                Negative
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="0"/> <span class="dash">-</span> <input
                                                            class="form-control input-sm" type="text" name=""
                                                            value="10"/>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-content-footer">
                                <button type="button" class="btn dark_btn dropdown-toggle"
                                        style="display: inline-block;"><i
                                        class="icon-filter4"></i><span> &nbsp;  Filter</span></button>
                                &nbsp; &nbsp;
                                <a style="display: inline-block;" href="#">Clear All</a>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn dark_btn ml20" id="addTagGroup" data-toggle="modal"><i
                            class="icon-plus3"></i><span> &nbsp;  New Tag Group</span></button>
                </div>
            </div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

        <!--================================= CONTENT START===============================-->
        <div class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading">
							<span class="pull-left">
								<h6 class="panel-title">{{ count($aGroupID) }} Tag Groups</h6>
							</span>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name"
                                               type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>&nbsp; &nbsp;
                                    <button type="button" class="btn btn-xs btn-default editDataList"><i
                                            class="icon-pencil position-left"></i> Edit
                                    </button>
                                    <button id="deleteTagsGroupBtn" class="btn btn-xs custom_action_box"><i
                                            class="icon-trash position-left"></i> Delete
                                    </button>
                                    <button id="archiveTagsGroupBtn" class="btn btn-xs custom_action_box"><i
                                            class="icon-gear position-left"></i> Archive
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                @if (!empty($aGroupID))
                                    <table class="table datatable-basic datatable-sorting tags">
                                        <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction" style="width:30px;">
                                                <label class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                                name="checkAll[]"
                                                                                                class="control-primary"
                                                                                                id="checkAll"><span
                                                        class="custmo_checkmark"></span></label></th>
                                            <th class="width-320"><i class="icon-user"></i>Name</th>
                                            <th><i class="icon-price-tag2"></i>Tags</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            foreach ($aGroupID as $gData):
                                                $sGroupName  = $gData['group_name'];
                                                $sGroupStatus  = $gData['status'];
                                                $iGroupID  = $gData['id'];
                                                if($sGroupStatus != 2){
                                        @endphp
                                        <tr>
                                            <td style="display: none;">{{ date('m/d/Y', strtotime($oContact->created)) }}</td>
                                            <td style="display: none;">{{ $oContact->id }}</td>
                                            <td style="display: none;" class="editAction"><label
                                                    class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                             name="checkRows[]"
                                                                                             class="checkRows"
                                                                                             value="{{ $iGroupID }}"><span
                                                        class="custmo_checkmark"></span></label></td>
                                            <td class="width-320" width="320">
                                                <div class="media-left media-middle"><a class="icons square" href="#"><i
                                                            class="icon-folder2 txt_blue"></i></a></div>
                                                <div class="media-left">
                                                    <div class="pt-3"><a href="#"
                                                                         class="text-default text-semibold editTagGroup"
                                                                         groupID="{{ $iGroupID }}"><span>{{ $sGroupName }}</span></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $i = 0;
                                                    $hiddenTags = '';
                                                    foreach ($aTag as $oTag): if ($oTag->id == $iGroupID): $i++;
                                                @endphp

                                                @if(!empty($oTag->tagid))
                                                    <button class="btn btn-xs btn_white_table pr10 editTagGroupEntity"
                                                            tagid="{{ $oTag->tagid }}" groupid="{{  $iGroupID }}"><i
                                                            class="icon-primitive-dot txt_dblue"></i> {{ $oTag->tag_name }}
                                                    </button>
                                                @endif

                                                @php
                                                    endforeach;
                                                @endphp

                                                <button class="btn btn-xs btn_white_table addnewtag"
                                                        data-group-id="{{ $iGroupID }}"><i class="icon-plus3"></i>
                                                </button>
                                                <span id="addnewtag_{{ $iGroupID }}" class="addnewtagcontainer"
                                                      style="display:none;">
													<form method="post" name="frmaddTagGroupEntityModal"
                                                          id="frmaddTagGroupEntityModal" action="javascript:void();"
                                                          style="display:inline-block;">
														@csrf
														<div class="input_box"><input class="form-control input-sm h26"
                                                                                      name="txtTagName"
                                                                                      placeholder="Enter tag name"
                                                                                      type="text"
                                                                                      required="required"></div>
														<button class="btn btn-xs btn_white_table hideaddnewtag"><i
                                                                class="icon-cross2 txt_red"></i></button>
														<button type="submit" class="btn btn-xs btn_white_table"><i
                                                                class="icon-checkmark3 txt_green"></i></button>
														<input type="hidden" name="groupID" value="{{ $iGroupID }}"
                                                               id="tagGroupID"/>
													</form>
												</span>
                                            </td>
                                        </tr>
                                        <!--================================================-->
                                        @php
                                            }
                                            endforeach;
                                        @endphp
                                        </tbody>
                                    </table>
                                @else
                                    <table class="table datatable-basic datatable-sorting">
                                        <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th class="width-320"><i class="icon-user"></i>Name</th>
                                            <th><i class="icon-price-tag2"></i>Tags</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="margin: 20px 0px 0;" class="text-center">
                                                            <h5 class="mb-20">
                                                                Looks Like You Don’t Have Any Tag Group <img
                                                                    src="{{ base_url('assets/images/smiley.png') }}">
                                                                <br>
                                                                Lets Create Tag Group.
                                                            </h5>
                                                            <button type="button" class="btn dark_btn ml20 addTagGroup"
                                                                    id="addTagGroup" data-toggle="modal"><i
                                                                    class="icon-plus3"></i><span> &nbsp;  New Tag Group</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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

            <div class="tab-pane" id="right-icon-tab1">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading">
							<span class="pull-left">
								<h6 class="panel-title">{{ count($aGroupID) }} Tag Groups</h6>
							</span>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name"
                                               type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>&nbsp; &nbsp;
                                    <button type="button" class="btn btn-xs btn-default editArchiveDataList"><i
                                            class="icon-pencil position-left"></i> Edit
                                    </button>
                                    <button id="deleteArchiveTagsGroupBtn" class="btn btn-xs custom_action_box_archive">
                                        <i class="icon-trash position-left"></i> Delete
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                @if (!empty($aGroupID))
                                    <table class="table datatable-basic datatable-sorting tags">
                                        <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editArchiveAction"
                                                style="width:30px;"><label class="custmo_checkbox pull-left"><input
                                                        type="checkbox" name="checkAll[]" class="control-primary"
                                                        id="checkAllArchive"><span
                                                        class="custmo_checkmark"></span></label></th>
                                            <th class="width-320"><i class="icon-user"></i>Name</th>
                                            <th><i class="icon-price-tag2"></i>Tags</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            foreach ($aGroupID as $gData):
                                            $sGroupName  = $gData['group_name'];
                                            $sGroupStatus  = $gData['status'];
                                            $iGroupID  = $gData['id'];
                                            if($sGroupStatus == 2){
                                        @endphp
                                        <!--================================================-->
                                        <tr>
                                            <td style="display: none;">{{ date('m/d/Y', strtotime($oContact->created)) }}</td>
                                            <td style="display: none;">{{ $oContact->id }}</td>
                                            <td style="display: none;" class="editArchiveAction">
                                                <label class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                                name="checkRows[]"
                                                                                                class="checkRowsArchive"
                                                                                                value="{{ $iGroupID }}"><span
                                                        class="custmo_checkmark"></span></label></td>
                                            <td class="width-320" width="320">
                                                <div class="media-left media-middle"><a class="icons square" href="#"><i
                                                            class="icon-folder2 txt_blue"></i></a></div>
                                                <div class="media-left">
                                                    <div class="pt-3">
                                                        <a href="#" class="text-default text-semibold editTagGroup"
                                                           groupID="{{ $iGroupID }}">
                                                            <span>{{ $sGroupName }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $i = 0;
                                                    $hiddenTags = '';
                                                    foreach ($aTag as $oTag):
                                                        if ($oTag->id == $iGroupID):
                                                            $i++;
                                                @endphp

                                                @if(!empty($oTag->tagid))
                                                    <button class="btn btn-xs btn_white_table pr10 editTagGroupEntity"
                                                            tagid="{{ $oTag->tagid }}" groupid="{{ $iGroupID }}"><i
                                                            class="icon-primitive-dot txt_dblue"></i> {{ $oTag->tag_name }}
                                                    </button>
                                                @endif

                                                @php
                                                    endif;
                                                endforeach;
                                                @endphp

                                                <button class="btn btn-xs btn_white_table addnewtag"
                                                        data-group-id="{{ $iGroupID }}"><i class="icon-plus3"></i>
                                                </button>
                                                <span id="addnewtag_{{ $iGroupID }}" class="addnewtagcontainer"
                                                      style="display:none;">
													<form method="post" name="frmaddTagGroupEntityModal"
                                                          id="frmaddTagGroupEntityModal" action="javascript:void();"
                                                          style="display:inline-block;">
														@csrf
														<div class="input_box"><input class="form-control input-sm h26"
                                                                                      name="txtTagName"
                                                                                      placeholder="Enter tag name"
                                                                                      type="text"
                                                                                      required="required"></div>
														<button class="btn btn-xs btn_white_table hideaddnewtag"><i
                                                                class="icon-cross2 txt_red"></i></button>
														<button type="submit" class="btn btn-xs btn_white_table"><i
                                                                class="icon-checkmark3 txt_green"></i></button>
														<input type="hidden" name="groupID" value="{{ $iGroupID }}"
                                                               id="tagGroupID"/>
													</form>
												</span>
                                            </td>
                                        </tr>
                                        <!--================================================-->
                                        @php
                                            }
                                            endforeach;
                                        @endphp
                                        </tbody>
                                    </table>

                                @else

                                    <table class="table datatable-basic datatable-sorting">
                                        <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th class="width-320"><i class="icon-user"></i>Name</th>
                                            <th><i class="icon-price-tag2"></i>Tags</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="margin: 20px 0px 0;" class="text-center">
                                                            <h5 class="mb-20">
                                                                Looks Like You Don’t Have Archive Data <img
                                                                    src="{{ base_url('assets/images/smiley.png') }}">
                                                                <br>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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
        </div>
        <!--================================= CONTENT END===============================-->
    </div>


    <div id="addContactNew" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Services Tag Group</h5>
                </div>
                <div class="modal-body p30">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_blue"></i> Email
                            </button>
                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_dblue"></i> Customers
                            </button>
                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_purple"></i> Reviews
                            </button>
                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_green"></i> Email Sent
                            </button>

                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_blue"></i> Email
                            </button>
                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_dblue"></i> Customers
                            </button>
                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_purple"></i> Reviews
                            </button>
                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_green"></i> Email Sent
                            </button>

                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_blue"></i> Email
                            </button>
                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_dblue"></i> Customers
                            </button>
                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_purple"></i> Reviews
                            </button>
                            <button class="btn btn-xs btn_white_table pr10 mr10 mb20"><i
                                    class="icon-primitive-dot txt_green"></i> Email Sent
                            </button>
                            <button class="btn btn-xs btn_white_table mr10 mb20"><i class="icon-plus3"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-link text-muted" data-dismiss="modal"><i class="icon-pencil4"></i> &nbsp;
                        Edit group
                    </button>
                    <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_blue"><i
                            class="icon-plus3"></i> Add new tag
                    </button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div id="addTagGroupModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" name="frmaddTagGroupModal" id="frmaddTagGroupModal" action="javascript:void();">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Add New Tag Group</h5>
                    </div>

                    <div class="modal-body">
                        <p>Group Name</p>
                        <input class="form-control" id="txtGroupName" name="txtGroupName" placeholder="Enter Group Name"
                               type="text" required>
                        <span id="groupvalidationerror" style="color:#FF0000;"></span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="addTagGroupEntityModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" name="frmaddTagGroupEntityModal" id="frmaddTagGroupEntityModal"
                      action="javascript:void();">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Add New Tag</h5>
                    </div>

                    <div class="modal-body">
                        <p>Tag Name</p>
                        <input class="form-control" id="txtTagName" name="txtTagName" placeholder="Enter Tag Name"
                               type="text" required>
                        <span id="AddGroupEntityduplicateValidation" style="color:#FF0000;"></span>
                    </div>

                    <div class="modal-footer">
                        <div class="text-left alert alert-success" style="display:none;" id="addedentitysuccess"></div>
                        <input type="hidden" name="groupID" id="tagGroupID"/>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editTagGroupModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" name="frmeditTagGroupModal" id="frmeditTagGroupModal" action="javascript:void();">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Update Tag Group</h5>
                    </div>

                    <div class="modal-body" style="margin-bottom: 50px;">
                        <p>Group Name</p>

                        <div class="col-md-11"><input class="form-control" id="txtEditGroupName" name="txtEditGroupName"
                                                      placeholder="Enter Group Name" type="text" required></div>
                        <div class="col-md-1">
                            <button type="button" class="btn red deleteTagGroup" groupID=""><i class="fa fa-trash"></i>
                            </button>
                        </div>
                        <span id="groupvalidationerrorupdate" style="color:#FF0000;"></span>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="groupID" id="editTagGroupID"/>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editTagGroupEntityModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" name="frmeditTagGroupEntityModal" id="frmeditTagGroupEntityModal"
                      action="javascript:void();">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Manage Tag</h5>
                    </div>

                    <div class="modal-body">
                        <p>Tag Name</p>
                        <div class="row">
                            <div class="col-md-11"><input class="form-control" id="txtEditTagName" name="txtEditTagName"
                                                          placeholder="Enter Tag Name" type="text" required></div>
                            <div class="col-md-1">
                                <button type="button" class="btn red deleteTagGroupEntity" tagid="" groupid=""><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        </div>

                        <span id="AddGroupEntityduplicateValidationUpdate" style="color:#FF0000;"></span>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="tagID" id="editTagGroupEntityID"/>
                        <input type="hidden" name="groupID" id="editTagGroupIDForSync"/>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="ReviewTagListModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void();">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Apply Tags</h5>
                    </div>

                    <div class="modal-body" id="tagEntireList">

                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="review_id" id="tag_review_id"/>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="FeedbackTagListModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" name="frmFeedbackTagListModal" id="frmFeedbackTagListModal"
                      action="javascript:void();">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Apply Tags</h5>
                    </div>

                    <div class="modal-body" id="tagEntireList">

                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="feedback_id" id="tag_feedback_id"/>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $(document).on('change', '#checkAll', function () {
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

                if (totalCheckboxes == numberOfChecked) {
                    $('#checkAll').prop('checked', true);
                }
            });

            $(document).on('change', '#checkAllArchive', function () {
                if (false == $(this).prop("checked")) {
                    $(".checkRowsArchive").prop('checked', false);
                    $(".selectedClass").removeClass('success');
                    $('.custom_action_box_archive').hide();
                } else {
                    $(".checkRowsArchive").prop('checked', true);
                    $(".selectedClass").addClass('success');
                    $('.custom_action_box_archive').show();
                }
            });

            $(document).on('click', '.checkRowsArchive', function () {
                var inc = 0;
                var rowId = $(this).val();
                if (false == $(this).prop("checked")) {
                    $('#append-' + rowId).removeClass('success');
                } else {
                    $('#append-' + rowId).addClass('success');
                }

                $('.checkRowsArchive:checkbox:checked').each(function (i) {
                    inc++;
                });

                if (inc == 0) {
                    $('.custom_action_box_archive').hide();
                } else {
                    $('.custom_action_box_archive').show();
                }

                var numberOfChecked = $('.checkRowsArchive:checkbox:checked').length;
                var totalCheckboxes = $('.checkRowsArchive:checkbox').length;
                if (totalCheckboxes > numberOfChecked) {
                    $('#checkAllArchive').prop('checked', false);
                }

                if (totalCheckboxes == numberOfChecked) {
                    $('#checkAllArchive').prop('checked', true);
                }
            });

            $(".hideaddnewtag").click(function () {
                $(this).parent().parent().hide();
            });

            $(".addnewtag").click(function () {
                var groupid = $(this).attr('data-group-id');
                $("#addnewtag_" + groupid).toggle();
            });

            $(".showmore").click(function () {
                var viewmoreid = $(this).attr('viewmoreid');
                $("#" + viewmoreid).toggle();
            });

            $(document).on("click", ".listTags", function () {
                var groupID = $(this).attr("groupID");
                displayTagList(groupID);
            });


            $("#addTagGroup").click(function () {
                $("#addTagGroupModal").modal("show");
            });
            $(".addTagGroup").click(function () {
                $("#addTagGroupModal").modal("show");
            });

            $(document).on("click", ".addtag", function () {
                var groupID = $(this).attr('group_id');
                $("#addTagGroupEntityModal").modal("show");
                $("#tagGroupID").val(groupID);
                $("#AddGroupEntityduplicateValidation").html("").hide();
            });
            $(document).on("click", "#addTagEntity", function () {
                $("#addTagGroupEntityModal").modal("show");
                $("#AddGroupEntityduplicateValidation").html("").hide();
            });

            $("#frmaddTagGroupModal").submit(function () {
                var formdata = $("#frmaddTagGroupModal").serialize();
                $.ajax({
                    url: "{{ base_url('admin/tags/addgroup') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location.href = '';
                        } else if (data.status == 'error' && data.type == 'duplicate_entry') {
                            alert(data.msg);
                        }
                    }
                });
                return false;
            });

            $("#txtGroupName").keypress(function () {
                $("#groupvalidationerror").html("").hide();
            });


            $("form[name='frmaddTagGroupEntityModal']").submit(function () {
                var formdata = $(this).serialize();
                $.ajax({
                    url: "{{ base_url('admin/tags/addgroupentity') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location.href = '';
                            var groupID = $("#tagGroupID").val();
                            $("#addTagGroupEntityModal").modal("hide");
                            setTimeout(function () {
                                $("#addedentitysuccess").html("").hide();
                            }, 5000);

                        } else if (data.status == 'error' && data.type == 'duplicate_entry') {
                            //$("#AddGroupEntityduplicateValidation").html(data.msg).show();
                            alert(data.msg);
                        }
                    }
                });
                return false;
            });

            $(document).on("keypress", "#txtTagName", function () {
                $("#AddGroupEntityduplicateValidation").html("").hide();
            });

            $(document).on("click", ".editTagGroup", function () {
                var groupid = $(this).attr("groupID");
                $("#txtEditGroupName").val('');
                $.ajax({
                    url: "{{ base_url('admin/tags/editgroup') }}",
                    type: "POST",
                    data: {'groupid': groupid},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $("#editTagGroupID").val(data.group_id);
                            $("#txtEditGroupName").val(data.group_name);
                            //Display Edit Group Popup
                            $(".deleteTagGroup").attr("groupID", groupid);
                            $("#editTagGroupModal").modal("show");
                            $("#groupvalidationerrorupdate").html("").hide();
                        }
                    }
                });
            });


            $(document).on("click", ".editTagGroupEntity", function () {
                var tagID = $(this).attr("tagid");
                var groupID = $(this).attr("groupid");
                $.ajax({
                    url: "{{ base_url('admin/tags/editgroupentity') }}",
                    type: "POST",
                    data: {'tagID': tagID},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $("#editTagGroupEntityID").val(data.tag_id);
                            $("#txtEditTagName").val(data.tag_name);
                            $("#editTagGroupIDForSync").val(data.group_id);
                            //Display Edit Tag Popup
                            var elem = $(".deleteTagGroupEntity");
                            $(elem).attr("tagid", tagID);
                            $(elem).attr("groupid", groupID);
                            $("#editTagGroupEntityModal").modal("show");
                        }
                    }
                });
            });


            $("#frmeditTagGroupModal").submit(function () {
                var formdata = $("#frmeditTagGroupModal").serialize();
                $.ajax({
                    url: "{{ base_url('admin/tags/updategroup') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location.href = '';
                        } else if (data.status == 'error' && data.type == 'duplicate_entry') {
                            $("#groupvalidationerrorupdate").html(data.msg).show();
                        }
                    }
                });
                return false;
            });

            $("#txtEditGroupName").keypress(function () {
                $("#groupvalidationerrorupdate").html("").show();
            });


            $("#frmeditTagGroupEntityModal").submit(function () {
                var formdata = $("#frmeditTagGroupEntityModal").serialize();
                var groupID = $("#editTagGroupIDForSync").val();
                $.ajax({
                    url: "{{ base_url('admin/tags/updategroupentity') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $("#editTagGroupEntityModal").modal("hide");
                            window.location.href = '';
                        } else if (data.status == 'error' && data.type == 'duplicate_entry') {
                            $("#AddGroupEntityduplicateValidationUpdate").html(data.msg).show();
                        }
                    }
                });
                return false;
            });

            $("#txtEditTagName").keypress(function () {
                $("#AddGroupEntityduplicateValidationUpdate").html("").hide();
            });


            $(document).on('click', '.deleteTagGroup', function () {
                var elem = $(this);
                swal({
                        title: "Are you sure? You want to delete this tag group!",
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
                            var groupID = $(elem).attr('groupID');
                            $.ajax({
                                url: "{{ base_url('admin/tags/deleteTagGroup') }}",
                                type: "POST",
                                data: {id: groupID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = '';
                                    }
                                }
                            });
                        }
                    });
            });

            $(document).on('click', '.deleteTagGroupEntity', function () {
                var elem = $(this);
                swal({
                        title: "Are you sure? You want to delete this tag?",
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
                            var tagID = $(elem).attr('tagid');
                            var groupID = $(elem).attr('groupid');
                            $.ajax({
                                url: "{{ base_url('admin/tags/deleteTagGroupEntity') }}",
                                type: "POST",
                                data: {id: tagID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        $("#editTagGroupEntityModal").modal("hide");
                                        window.location.href = '';
                                    }
                                }
                            });
                        }
                    });
            });

            $(document).on("click", ".applyInsightTags", function () {
                var review_id = $(this).attr("reviewid");
                var feedback_id = $(this).attr("feedback_id");
                var action_name = $(this).attr("action_name");
                $.ajax({
                    url: "{{ base_url('admin/tags/listAllTags') }}",
                    type: "POST",
                    data: {id: 'Hi'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            $("#tagEntireList").html(data.list_tags);
                            $("#tag_review_id").val(review_id);
                            $("#tag_feedback_id").val(feedback_id);
                            if (action_name == 'review-tag') {
                                $("#ReviewTagListModal").modal("show");
                            } else if (action_name == 'feedback-tag') {
                                $("#FeedbackTagListModal").modal("show");

                            } else {
                                $("#ReviewTagListModal").modal("show");
                            }
                        }
                    }
                });
            });
        });

        function displayTagList(groupID) {
            $('.overlaynew').show();
            $.ajax({
                url: "{{ base_url('admin/tags/getTagList') }}",
                type: "POST",
                data: {groupID: groupID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#taglistcontainer").html(data.content);
                        $("#tagGroupID").val(groupID);
                    }
                }
            });
        }

        function displayTagGroupList() {
            $('.overlaynew').show();
            $.ajax({
                url: "{{ base_url('admin/tags/listAllGroupTags') }}",
                type: "POST",
                data: {action: 'showgrouptag'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#grouptaglistcontainer").html(data.list_tags);
                    }
                }
            });
        }

        $(document).on('click', '.editArchiveDataList', function () {
            $('.editArchiveAction').toggle();
        });

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });

        $(document).on('click', '#deleteTagsGroupBtn', function () {
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
                                url: "{{ base_url('admin/tags/deleteMultipleTagGroups') }}",
                                type: "POST",
                                data: {multipal_record_id: val},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = window.location.href;
                                    } else {
                                        $('.overlaynew').hide();
                                        alertMessage('Error: Some thing wrong!');
                                    }
                                }
                            });
                        }
                    });
            }
        });

        $(document).on('click', '#deleteArchiveTagsGroupBtn', function () {
            var val = [];
            $('.checkRowsArchive:checkbox:checked').each(function (i) {
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
                                url: "{{ base_url('admin/tags/deleteMultipleTagGroups') }}",
                                type: "POST",
                                data: {multipal_record_id: val},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = window.location.href;
                                    } else {
                                        $('.overlaynew').hide();
                                        alertMessage('Error: Some thing wrong!');
                                    }
                                }
                            });
                        }
                    });
            }
        });

        $(document).on('click', '#archiveTagsGroupBtn', function () {
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
                                url: "{{ base_url('admin/tags/archiveMultipleTagGroups') }}",
                                type: "POST",
                                data: {multipal_record_id: val},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = window.location.href;
                                    } else {
                                        $('.overlaynew').hide();
                                        alertMessage('Error: Some thing wrong!');
                                    }
                                }
                            });
                        }
                    });
            }
        });
    </script>
@endsection

