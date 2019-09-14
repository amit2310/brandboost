@extends('layouts.main_template')

@section('title')
@endsection

@section('contents')

<!-- Content area -->
@php
 if(!empty($campaignType))
 {
    $campaignType = $campaignType;
 }
 else
 {
    $campaignType="";
 }
@endphp

<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3>{{ $title }}</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="active">Active Segments</a></li>
                    <li><a style="javascript:void();" class="filterByColumn" fil="archive">Archive</a></li>

                </ul>

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
                                                <div class="col-md-12"> Content Goes here... </div>
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
                                                <div class="col-md-12"> Content Goes here... </div>
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
                                                <div class="col-md-12"> Content Goes here... </div>
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

                @if ($campaignType == 'Email')
                    <button type="button" class="btn bl_cust_btn new btn-default addBroadcast dark_btn ml20" broadcast_type="Email"><i class="icon-plus3"></i> &nbsp; Email Broadcast</button>
                @endif
                @if ($campaignType == 'SMS')
                    <button type="button" class="btn bl_cust_btn new btn-default addBroadcast dark_btn ml20" broadcast_type="SMS"><i class="icon-plus3"></i> &nbsp; SMS Broadcast</button>
                @endif
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
    @if (!empty($oSegments))
        <div class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <span class="pull-left">
                                    <h6 class="panel-title">{{ count($oSegments) }} Segments</h6>
                                </span>

                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableid="emailsmsSegment" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class=""><img src="{{ base_url() }}assets/images/icon_search.png" width="14"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="{{ base_url() }}assets/images/icon_refresh.png"></i></a>
                                        <!-- <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_calender.png"></i></a>
                                        <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_download.png"></i></a>
                                        <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_upload.png"></i></a> -->
                                        <a href="javascript:void(0);" class="brig pr-15 custom_action_box" id="syncAllSegments" style="display: none;">Sync Contacts &nbsp; <i class=""><img src="{{ base_url() }}assets/images/icon_refresh.png"></i></a>
                                        <a href="javascript:void(0);"><i class="editDataList"><img src="{{ base_url() }}assets/images/icon_edit.png"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" title="delete" id="deleteButtonBroadcast" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" title="archive" id="archiveButtonSegment" class="custom_action_box"><i class="icon-gear position-left"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table" id="emailsmsSegment">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th class="nosort editAction" style="width:30px;display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                            <!-- <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i> Segment Name</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_device.png"></i>Total Contacts</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_clock.png"></i>Created</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_source.png"></i>Campaign Name</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_source.png"></i>Module Name</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_social.png"></i>Campaign Type</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_social.png"></i>Source Type</th>
                                            <th><i class="icon-diff-modified"></i>Status</th>
                                            <th class="nosort sorting_disabled text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_action.png"></i>Action</th>
                                            <th style="display: none;"></th> -->

                                            <th><i class=""><img src="{{ base_url() }}assets/images/filter_black_10.png"/></i>Segment</th>
                                            <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/chat_user_icon.png" width="9"/></i>Contacts</th>
                                            <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_created.png"/></i>Created</th>

                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_source.png"></i>Campaign Name</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_source.png"></i>Module Name</th>

                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_hash.png"/></i>Sources</th>
                                            <th class="text-right">&nbsp;</th>
                                            <th style="display: none;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $aUser = getLoggedUser();
                                        $userID = $aUser->id;
                                        foreach ($oSegments as $oSegment) {
                                            $oSubscribers = \App\Models\Admin\BroadcastModel::getSegmentSubscribers($oSegment->id, $userID);
                                            $aCampaignIDs = unserialize($oSegment->source_campaign_id);
                                            $moduleName = $oSegment->source_module_name;
                                            if (!empty($aCampaignIDs)) {
                                                $campaignCollection = array();
                                                foreach ($aCampaignIDs as $campaignId) {
                                                    //$oCampaign = $this->mBroadcast->getBroadcastInfo($campaignId);
                                                    $modName = $moduleName;
                                                    if (in_array($moduleName, array('brandboost-onsite', 'brandboost-offsite'))) {
                                                        $modName = 'brandboost';
                                                    }

                                                    if (in_array($moduleName, array('nps-feedback'))) {
                                                        $modName = 'nps';
                                                    }
                                                    $oCampaign = $mWorkflow->getModuleUnitInfo($modName, $campaignId);
                                                    if (!empty($oCampaign)) {
                                                        //$campaignCollection[] = "<a target='_blank' href='" . base_url("admin/broadcast/edit/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                                                        if ($moduleName == 'brandboost') {
                                                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/brandboost/details/{$oCampaign->id}") . "'>{$oCampaign->brand_title}</a>";
                                                        } else if ($moduleName == 'brandboost-onsite') {
                                                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/brandboost/onsite_setup/{$oCampaign->id}") . "'>{$oCampaign->brand_title}</a>";
                                                        } else if ($moduleName == 'brandboost-offsite') {
                                                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/brandboost/offsite_setup/{$oCampaign->id}") . "'>{$oCampaign->brand_title}</a>";
                                                        } else if ($moduleName == 'broadcast') {
                                                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/broadcast/edit/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                                                        } else if ($moduleName == 'automation') {
                                                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/modules/emails/setupAutomation/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                                                        } else if ($moduleName == 'nps') {
                                                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/modules/nps/setup/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                                                        } else if ($moduleName == 'nps-feedback') {
                                                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/modules/nps/setup/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                                                        } else if ($moduleName == 'referral') {
                                                            $campaignCollection[] = "<a target='_blank' href='" . base_url("admin/modules/referral/setup/{$oCampaign->id}") . "'>{$oCampaign->title}</a>";
                                                        }
                                                    }
                                                }
                                            }
                                            @endphp
                                            <tr id="append-{{ $oSegment->id }}" class="selectedClass">
                                                <td style="display: none;">{{ date('m/d/Y', strtotime($oSegment->created)) }} </td>
                                                <td style="display: none;">{{ $oSegment->id }}</td>
                                                <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk{{ $oSegment->id}}" value="{{ $oSegment->id }}" ><span class="custmo_checkmark"></span></label></td>
                                                <!-- <td>
                                                    <div class="media-left media-middle"> <a class="icons br5" href="#"><img src="{{ base_url() }}assets/images/filter_blue_10.png" class="img-circle img-xs br5" alt=""></a> </div>
                                                    <div class="media-left">
                                                        <div class=""><a href="{{ base_url('admin/broadcast/edit/' . $oSegment->id) }}" segment_id="{{ $oSegment->id }}" class="text-default text-semibold">{{ setStringLimit($oSegment->segment_name, 20) }}</a></div>
                                                         <div class="text-muted text-size-small">
                                                {{ setStringLimit($oSegment->segment_name, 25) }}
                                                        </div>
                                                    </div>
                                                </td> -->

                                                <td><div class="media-left media-middle"> <a class="icons square" href="javascript:void(0);"><img src="{{ base_url() }}assets/images/filter_blue_10.png"/></a> </div>
                                                    <div class="media-left">
                                                        <div class="pt-3"><a href="javascript:void(0);" segment_id="{{ $oSegment->id }}"  class="text-default text-semibold"><span>{{ setStringLimit($oSegment->segment_name, 20) }} </span></a></div>
                                                    </div></td>


                                                <td class="text-right"><div class="media-left pull-right text-right"> <a href="{{ base_url() }}admin/broadcast/segmentcontacts/{{ $oSegment->id }}" class="text-default text-semibold">{{ count($oSubscribers) }} </a> </div></td>

                                                        <!-- <td>
                                                            <div class="media-left text-right">
                                                                <div class=""><a href="javascript:void(0);" class="text-default text-semibold">{{ dataFormat($oSegment->created) }} <span class="txt_grey">{{ date('h:i A', strtotime($oSegment->created)) }}</span></a> </div>
                                                            </div>
                                                        </td> -->

                                                <td class="text-right"><div class="media-left pull-right text-right pl20 pr20 brig blef">
                                                        <div class=""><a href="javascript:void();" class="text-default text-semibold">{{ dataFormat($oSegment->created) }} <span class="txt_grey">{{ date('h:i A', strtotime($oSegment->created)) }} </span></a> </div>
                                                    </div></td>

                                                <td>
                                                    <div class="media-left text-right">
                                                        <div class="">{!! (!empty($campaignCollection)) ? implode(",", $campaignCollection) : $oSegment->campaign_title !!}</div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="media-left text-right">
                                                        <div class="">{{ ucfirst($modName) }}</div>
                                                    </div>
                                                </td>

                                                        <!-- <td>
                                                            <div class="media-left text-right">
                                                                <div class="">{{ ucwords($oSegment->source_campaign_type) }}</div>
                                                            </div>
                                                        </td> -->

                                                <td>
                                                    <!-- <div class="media-left text-right">
                                                        <div class="">{{ ucwords($oSegment->source_segment_type) }}</div>
                                                    </div> -->

                                                    <button class="btn btn-xs btn_white_table pr10"> {{ ucwords($oSegment->source_segment_type) }}</button>
                                                    <button class="btn btn-xs plus_icon"><i class="icon-plus3"></i></button>
                                                </td>

                                                <td class="text-right"><div class="media-left pull-right text-right">
                                                        <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ base_url() }}assets/images/more.svg"></a>
                                                            <ul class="dropdown-menu dropdown-menu-right more_act">
                                                                <a href="#" class="dropdown_close">X</a>
                                                                <!-- <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                                <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                                <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                                <li><a href="#"><i class="icon-bin"></i> Delete</a> </li> -->

                                                                <li><a href="javascript:void(0);" segment_id="{{ $oSegment->id }}" class="editSegment"><i class="icon-file-stats"></i> Edit</a></li>

                                                                @if ($oSegment->status != 'archive')
                                                                    <li><a href="javascript:void(0);" class="moveArchive" segment_id="{{ $oSegment->id }}"><i class="icon-file-stats"></i> Move To Archive</a></li>
                                                                 @endif

                                                                <li><a href="javascript:void(0);" class="deleteSegment" segment_id="{{ $oSegment->id }}"><i class="icon-bin"></i> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="media-left pull-right text-right pl20 blef">
                                                        <div class=""> <a href="javascript:void(0);" class="syncContacts txt_blue" segment_id="{{ $oSegment->id }}"><span class="txt_blue_sky2">Sync</span></a> </div>
                                                    </div></td>

                                                <td style="display: none;">
                                                    @if ($oSegment->status != 1)
                                                        {{ 'archive' }}
                                                    @else
                                                        {{ 'active' }}
                                                    @endif
                                                </td>



                                            </tr>
                                            @php
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

    @else

        <div class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">{{ $iActiveCount }} Brand Boost Broadcast</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>&nbsp; &nbsp;

                                    <button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
                                    <button id="" class="btn custom_action_box btn-xs">Delete</button>
                                    <button id="" class="btn custom_action_box btn-xs">Archive</button>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic datatable-sorting">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th class="nosort" style="width:30px;"><label class="custmo_checkbox pull-left" style="display:none;"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i> Segment Name</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_device.png"></i>Total Contacts</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_clock.png"></i>Created</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_source.png"></i>Campaign Source</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_social.png"></i>Campaign Type</th>
                                            <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td colspan="10">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="margin: 20px 0px 0;" class="text-center">
                                                            <h5 class="mb-20 mt40">
                                                                Looks Like You Don’t Have Any Segment Yet <img src="{{ site_url('assets/images/smiley.png') }}"> <br>

                                                            </h5>



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
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

</div>

<!-- Add Segment Popup -->
<div id="addSegment" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="addBroadcastSegment" id="addBroadcastSegment" action="javascript:void();">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="{{ base_url() }}assets/css/menu_icons/Email_Color.svg"/> Add Segment &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Segment Title:</label>
                                <input class="form-control" id="segmentName" name="segmentName" placeholder="Enter Segment Title" type="text" required>
                                <div id="addSegmentValidation" style="color:#FF0000;display:none;"></div>

                            </div>

                            <div class="form-group mb0">
                                <label>Segment Description:</label>
                                <input class="form-control h52" type="text" id="segmentDescription" name="segmentDescription" value="" placeholder="Enter segment description"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="broadcastID" id="hidSegmentCampaignID">
                    <input type="hidden" value="Email" name="segmentType" id="hidSegmentType">
                    <input type="hidden" value="Email" name="campaignType" id="hidCampaignType">

                    <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Broadcast Modal-->

<div id="addBroadcast" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="addBroadcastData" id="addBroadcastData" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="{{ base_url() }}assets/css/menu_icons/Email_Color.svg"/> Add Brand Boost Broadcast &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Please Enter Title below:</label>
                                <input class="form-control" id="campaignName" name="campaignName" placeholder="Enter Title" type="text" required>

                            </div>

                            <div class="form-group mb0">
                                <label>Please Enter Description:</label>
                                <input class="form-control h52" type="text" id="description" name="description" value="" placeholder="Enter broadcast description"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="campaignTemplateID" id="campaignTemplateID">
                    <textarea id="campaignTemplateContant" style="display:none;"></textarea>
                    <input type="hidden" value="Email" name="broadCastType" id="broadCastType">
                    <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>


<!-- /Add Broadcast -->

<!-- Update Broadcast Modal-->
<!-- <div id="updateBroadcast" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="updateBroadcastData" class="form-horizontal" id="updateBroadcastData" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Update Brand Boost Broadcast</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="mt0">Campaign Name</h3>
                            <p>Enter a name to help you remember what this campaign is all about. Only you will see this.</p>
                            <input class="form-control" type="text" name="edit_broadcast" id="edit_broadcast" value="" placeholder="Campaign Name" />

                            <h3 class="mt10">Description</h3>
                            <textarea class="form-control" id="edit_description" name="edit_description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p40">
                    <input type="hidden" value="" name="edit_broadcastId" id="edit_broadcastId">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- /Add Broadcast -->


<div id="editSegmentModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmeditSegmentModel" name="frmeditSegmentModel">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="/assets/images/menu_icons/List_Color.svg"/> Edit Segment &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>


                </div>
                <div class="modal-body" style="padding-bottom:0px;">
                    <p>Segment Name:</p>
                    <input class="form-control h52" id="edit_title" name="title" placeholder="Enter List Name" type="text" required><br>
                    <div id="editlistValidation" style="color:#FF0000;display:none;"></div>
                </div>
                <div class="modal-body" style="padding-top:0px;">
                    <p>Segment Description:</p>
                    <textarea class="form-control h52" id="edit_description" name="edit_description"></textarea>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="segment_id" id="hidSegmentid" value="" />
                    <button type="submit" class="btn btn-primary h52">Update</button>
                    <button type="button" class="btn btn-link h52" data-dismiss="modal">Close</button>


                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('#emailsmsSegment thead tr').clone(true).appendTo('#emailsmsSegment thead');

        $('#emailsmsSegment thead tr:eq(1) th').each(function (i) {

            if (i === 10) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value, $('#colStatus').prop('checked', true))
                                .draw();
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

        // Basic datatable
        var tableId = 'emailsmsSegment';
        var tableBase = custom_data_table(tableId);
        $('table thead tr:eq(1)').hide();
        $('#activeCampaign').trigger('click');


    });





    $(document).ready(function () {

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

        $(document).on('click', '#deleteButtonBroadcast', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
                        "This segment will deleted immediately.<br>You can't undo this action.",
                        function () {

                            $('.overlaynew').show();
                            $.ajax({
                                url: "{{ base_url('admin/broadcast/deleteMultipalSegment') }}",
                                type: "POST",
                                data: {multiSegmentid: val},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        location.reload();
                                    } else {
                                        alert("Having some error.");
                                    }
                                },
                                error: function (error) {
                                    console.log(error);
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


        $(document).on("click", ".editSegment", function () {
            var segmentID = $(this).attr('segment_id');
            $.ajax({
                url: "{{ base_url('admin/broadcast/getSegment') }}",
                type: "POST",
                data: {'segment_id': segmentID,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        console.log(data);
                        $("#edit_title").val(data.title);
                        $("#edit_description").val(data.description);
                        $("#hidSegmentid").val(segmentID);
                        $("#editSegmentModel").modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });


        $('#frmeditSegmentModel').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmeditSegmentModel").serialize();
            var listID = $("#hidsegmentid").val();
            $.ajax({
                url: "{{ base_url('admin/broadcast/updateSegment') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#editSegmentModel").modal('hide');
                        window.location.href = '';
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#editlistValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#editlistValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });


        $(document).on('click', '#deleteButtonBroadcastA', function () {
            var val = [];
            $('.checkRowsA:checkbox:checked').each(function (i) {
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
                                    url: "{{ base_url('admin/modules/emails/multipalDeleteAutomation') }}",
                                    type: "POST",
                                    data: {multipal_automation_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = window.location.href;
                                        }
                                    }
                                });
                            }
                        });
            }
        });


        $(document).on('click', '#archiveButtonSegment', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                archiveConfirmationPopup(
                        "This segment will move to archive immediately.<br>You can't undo this action.",
                        function () {

                            $('.overlaynew').show();
                            $.ajax({
                                url: "{{ base_url('admin/broadcast/archive_multipal_segment') }}",
                                type: "POST",
                                data: {multi_segment_id: val,_token: '{{csrf_token()}}'},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        location.reload();
                                    } else {
                                        alert("Having some error.");
                                    }
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            });
                        });

            }
        });



        $('[data-toggle="tooltip"]').tooltip();

        $('.addBroadcast').click(function () {
            $('.campaignContainer .hide_sms, .campaignContainer .hide_email').show();
            if ($(this).attr('broadcast_type') == 'Email') {
                $('.campaignContainer .hide_sms').hide();
            } else {
                $('.campaignContainer .hide_email').hide();
            }
            $('#broadCastType').val($(this).attr('broadcast_type'));
            $("#addBroadcast").modal();
        });

        $('.hideABModalBox').click(function () {
            $("#addBroadcast").modal('hide');
        });

        $('.select_campaign_box').click(function () {
            var templateID = $(this).attr('template_id');
            var templateContent = $(this).attr('template_content');
            $('#campaignTemplateID').val(templateID);
            $('#campaignTemplateContant').val(templateContent);
            $('.select_campaign_box').css('border', '1px solid #e6e6e6');
            $(this).css('border', '3px solid #1F8EE7');
        });

        $('.editBroadcast').click(function () {
            var broadcastId = $(this).attr('broadcast_id');
            var broadcastTitle = $(this).attr('broadcast_title');
            var broadcastDes = $(this).attr('broadcast_des');
            $('#edit_broadcast').val(broadcastTitle);
            $('#edit_description').val(broadcastDes);
            $('#edit_broadcastId').val(broadcastId);
            $("#updateBroadcast").modal();
        });

        $(document).on('click', '.clonBroadcastCampaign', function () {
            var automationID = $(this).attr('broadcast_id');
            $.ajax({
                url: "{{ base_url('admin/broadcast/clonBroadcastCampaign') }}",
                type: "POST",
                data: {automation_id: automationID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //window.location.href = window.location.href;
                        $('#edit_broadcast').val(data.broadcastName);
                        $('#edit_description').val(data.description);
                        $('#edit_broadcastId').val(data.broadcastId);
                        $("#updateBroadcast").modal();
                    }
                }
            });
        });

        $(document).on('click', '.moveArchive', function () {
            var val = [];
            var segmentID = $(this).attr('segment_id');
            val[0] = segmentID;
            archiveConfirmationPopup(
                    "This segment will move to archive immediately.<br>You can't undo this action.",
                    function () {

                        $('.overlaynew').show();
                        $.ajax({
                            url: "{{ base_url('admin/broadcast/archive_multipal_segment') }}",
                            type: "POST",
                            data: {multi_segment_id: val,_token: '{{csrf_token()}}'},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    location.reload();
                                } else {
                                    alert("Having some error.");
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    });

        });


        $(document).on('click', '.deleteSegment', function () {
            var elem = $(this);

            deleteConfirmationPopup(
                    "This record will deleted immediately.<br>You can't undo this action.",
                    function () {
                        $('.overlaynew').show();
                        var segmentID = $(elem).attr('segment_id');
                        $.ajax({
                            url: "{{ base_url('admin/broadcast/deleteSegment') }}",
                            type: "POST",
                            data: {segmentID: segmentID,_token: '{{csrf_token()}}'},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    $('.overlaynew').hide();
                                    window.location.href = window.location.href;
                                }
                            }
                        });
                    });

        });

        $('#updateBroadcastData').submit(function () {
            var campaignName = $('#edit_broadcast').val();
            var description = $('#edit_description').val();
            var broadcastId = $('#edit_broadcastId').val();
            if (campaignName == '') {
                alertMessage('Please enter campaign name.');
            } else {
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('admin/broadcast/updateBroadcastClone') }}",
                    type: "POST",
                    data: {edit_broadcastId: broadcastId, campaign_name: campaignName, description: description},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            window.location.href = '{{ base_url('admin/broadcast/edit/') }}' + broadcastId;
                        } else {
                            $('.overlaynew').hide();
                            alertMessage('Error: Some thing wrong!');
                            return false;
                        }
                    }, error: function (xhr, status, error) {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                });
            }
            return false;
        });


        $('#addBroadcastData').submit(function () {
            var campaignName = $('#campaignName').val();
            var description = $('#description').val();
            var broadCastType = $('#broadCastType').val();
            var campaignTemplateID = $('#campaignTemplateID').val();
            var campaignTemplateContant = $('#campaignTemplateContant').val();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ base_url('admin/broadcast/createBroadcast') }}",
                type: "POST",
                data: {'campaign_name': campaignName, 'template_name': campaignTemplateID, 'description': description, 'template_content': campaignTemplateContant, 'broadcast_type': broadCastType},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '{{ base_url() }}admin/broadcast/edit/' + data.broadcastId;
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error: function () {
                    $('.overlaynew').hide();
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });

        $(document).on("click", ".createSegment", function () {

            var campaignID = $(this).attr('campaign-id');
            var segmentType = $(this).attr('segment-type');
            var campaignType = $(this).attr('campaign-type')
            $("#hidSegmentCampaignID").val(campaignID);
            $("#hidSegmentType").val(segmentType);
            $("#hidCampaignType").val(campaignType);
            $("#addSegment").modal("show");
        });

        $('#addBroadcastSegment').submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ base_url('admin/broadcast/createSegment') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        displayMessagePopup('sccess', '', 'Segment created successfully!');
                        $("#addSegment").modal("hide");

                    } else if (data.status == 'error' && data.msg == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#addSegmentValidation").html('Segment with the same name already exists. Choose other title please').show();
                        setTimeout(function () {
                            $("#addSegmentValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });


        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });

        $(document).on('click', '.editArchiveDataList', function () {
            $('.editArchiveAction').toggle();
        });

        $(document).on('click', '.syncContacts', function () {
            var segmentID = $(this).attr('segment_id');
            $('.overlaynew').show();
            $.ajax({
                url: "{{ base_url('admin/segments/syncSegment') }}",
                type: "POST",
                data: {segmentID: segmentID,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        syncContactSelectionSources();
                        displayMessagePopup('sccess', '', 'Segment contacts have been synced successfully!');
                        setTimeout(function () {
                            window.location.href = '';
                        }, 1000);

                    } else {
                        $('.overlaynew').hide();
                        displayMessagePopup('error', '', 'Some thing wrong!');
                    }
                }, error: function () {
                    $('.overlaynew').hide();
                    displayMessagePopup('error', '', 'Some thing wrong!');
                }
            });
        });


        $(document).on('click', '#syncAllSegments', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('admin/broadcast/syncSegmentMultiple') }}",
                    type: "POST",
                    data: {segmentCollection: val,_token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            displayMessagePopup('sccess', '', 'Segment contacts have been synced successfully!');
                            window.location.href = '';
                        } else {
                            $('.overlaynew').hide();
                            displayMessagePopup('error', '', 'Some thing wrong!');
                        }
                    }, error: function () {
                        $('.overlaynew').hide();
                        displayMessagePopup('error', '', 'Some thing wrong!');
                    }
                });

            }


        });







    });
</script>
@endsection
