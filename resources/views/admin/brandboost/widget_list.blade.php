@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')

@php

list($canRead, $canWrite) = fetchPermissions('Onsite Campaign');
        
$iActiveCount = $iArchiveCount = 0;
//$oWidgetsList =  array();

if (!empty($oWidgetsList)) {
    foreach ($oWidgetsList as $oCount) {
        if ($oCount->status == 3) {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}
$aViews = array();
$aClicks = array();
$aComments = array();
$aHelpful = array();
$aViews1 = array();
$aClicks1 = array();
$aComments1 = array();
$aHelpful1 = array();
$aViews2 = array();
$aClicks2 = array();
$aComments2 = array();
$aHelpful2 = array();
@endphp
<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><img src="{{ base_url() }}assets/images/onsite_icons.png"> Onsite Widgets</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Active Widgets</a></li>
                    <li><a href="#right-icon-tab1" data-toggle="tab">Archive</a></li>
                    <li><a href="#right-icon-tab4" data-toggle="tab">Statistics</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Widget &nbsp; &nbsp; <span class="caret"></span>
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

                
                <button 
                    @if ($bActiveSubsription == false)  
                        title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription" 
                    @else
                        id="addBrandboostWidget" class="btn bl_cust_btn btn-default dark_btn ml20" 
                    @endif
                        type="button" >
                        <i class="icon-plus3"></i> Add On Site Widget
                </button>
                    

            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->


    <div class="tab-content">
        @if (!empty($oWidgetsList))
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">{{ $iActiveCount }} Onsite Widgets 1</h6>
                                <div class="heading-elements">

                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="javascript:void(0)"><i class="icon-calendar52"></i></a>
                                        <a href="javascript:void(0)" class="editDataList"><i class="icon-pencil"></i></a>
                                        <button id="deleteButtonBrandboostOnlineWidget" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                                        <button id="archiveButtonOnsiteWidget" class="btn btn-xs custom_action_box"><i class="icon-gear position-left"></i> Archive</button>
                                    </div>

                                </div>
                            </div>

                            <div class="panel-body p0">
                                <table class="table datatable-basic datatable-sorting">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                            <th><i class="icon-stack-star"></i>Name</th>
                                            <th><i class="icon-stack-star"></i>Widget Type</th>
                                            <th><i class="icon-stack-star"></i>Onsite Campaign</th>
                                            <th><i class="icon-calendar"></i>Created</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Views</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Clicks</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Commented</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Helpful</th>
                                            <th><i class="fa fa-dot-circle-o"></i>Status</th>
                                            <th><i class="fa fa-dot-circle-o"></i>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                        $inc = 1;
                                        $aUser = getLoggedUser();
                                        $currentUserId = $aUser->id;

                                        foreach ($oWidgetsList as $data) {
                                            $wid = $data->id;
                                            $oStats = \App\Models\Admin\BrandboostModel::getBBWidgetStats($wid);
                                            //widget Stats related Data
                                            if (!empty($oStats)) {
                                                foreach ($oStats as $oStat) {
                                                    if ($oStat->track_type == 'view') {
                                                        $aViews[] = $oStat;
                                                    } else if ($oStat->track_type == 'click') {
                                                        $aClicks[] = $oStat;
                                                    } else if ($oStat->track_type == 'comment') {
                                                        $aComments[] = $oStat;
                                                    } else if ($oStat->track_type == 'helpful') {
                                                        $aHelpful[] = $oStat;
                                                    }

                                                    $totalRecords = count($oStats);
                                                    $totalViews = count($aViews);
                                                    $totalClicks = count($aClicks);
                                                    $totalComments = count($aComments);
                                                    $totalHelpful = count($aHelpful);
                                                }
                                            }

                                            if ($data->status == 1 or $data->status == 0 or $data->status == 2) {
                                                $list_id = $data->id;
                                                $user_id = $data->user_id;

                                                //Attached camapaign brand Image
                                                if (empty($data->campaignImg)) {
                                                    $campaignImgArray = unserialize($data->campaignImg);
                                                    $campaign_img = $campaignImgArray[0]['media_url'];

                                                    if (empty($campaign_img)) {
                                                        $campaignImgSrc = base_url('assets/images/default_table_img2.png');
                                                        $imgSrc = base_url('assets/images/default_table_img2.png');
                                                    } else {
                                                        $campaignImgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $campaign_img;
                                                        $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $campaign_img;
                                                    }
                                                } else {
                                                    $campaignImgSrc = base_url('assets/images/default_table_img2.png');
                                                    $imgSrc = base_url('assets/images/default_table_img2.png');
                                                }
                                                @endphp

                                                <tr id="append-{{ $data->id }}" class="selectedClass">
                                                    <td style="display: none;">{{ date('m/d/Y', strtotime($data->created)) }}</td>
                                                    <td style="display: none;">{{ $data->id }}</td>
                                                    <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk{{ $data->id }}" value="{{ $data->id }}" ><span class="custmo_checkmark"></span></label></td>
                                                    <td>
                                                        <div class="media-left media-middle">
                                                            <a href="{{ base_url('admin/brandboost/onsite_widget_setup/' . $data->id) }}" widgetID="{{ $data->id }}" b_title="{{ $data->widget_title }}" class="text-default text-semibold">
                                                                <img src="{{ $imgSrc }}" class="img-circle img-xs br5" alt="Img"></a>
                                                        </div>
                                                        <div class="media-left">
                                                            <div class=""><a href="{{ base_url('admin/brandboost/onsite_widget_setup/' . $data->id) }}" widgetID="{{ $data->id }}" b_title="{{ $data->brand_title }}" class="text-default text-semibold">{{ $data->widget_title }}</a></div>
                                                            <div class="text-muted text-size-small">
                                                                {!! setStringLimit($data->widget_desc) !!}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        @if ($data->widget_type == 'cpw')
                                                             Center Popup
                                                        @elseif ($data->widget_type == 'vpw') 
                                                            Vertical Popup
                                                        @elseif ($data->widget_type == 'bww') 
                                                            Button Widget Popup
                                                        @elseif ($data->widget_type == 'bfw') 
                                                            Bottom Fixed Popup
                                                        @elseif ($data->widget_type == 'rfw')
                                                            Embeded Reviews
                                                        @else
                                                            <span style="font-size:11px;">[No Data]</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!empty($data->brandboost_id))
                                                            <div class="media-left media-middle">
                                                                <a href="{{ base_url('admin/brandboost/onsite_setup/' . $data->brandboost_id) }}>" class="text-default text-semibold">
                                                                    <img src="{{ $campaignImgSrc }}" class="img-circle img-xs br5" alt="Img">
                                                                </a>
                                                            </div>
                                                            <div class="media-left">
                                                                <a href="{{ base_url("admin/brandboost/onsite_setup/" . $data->brandboost_id) }}" target="_blank">
                                                        @endif
                                                                    {!! ($data->bbBrandTitle) ? $data->bbBrandTitle : '<span style="font-size:11px;">[No Data]</span>' !!}                                                            
                                                        @if (!empty($data->brandboost_id))
                                                                </a>
                                                                <div class="text-muted text-size-small">
                                                                    {!! setStringLimit($data->bbBrandDesc) !!}
                                                                </div>    
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="media-left">
                                                            <div class="pt-5"><span class="text-default text-semibold">{{ dataFormat($data->created) }}</span></div>
                                                            <div class="text-muted text-size-small">{{ date('h:i A', strtotime($data->created)) }}</div>
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        @php //echo ($totalViews) ? $totalViews : '0' @endphp0
                                                    </td>

                                                    <td class="text-center">
                                                        @php //echo ($totalClicks) ? $totalClicks : '0' @endphp0
                                                    </td>

                                                    <td class="text-center">
                                                        @php //echo ($totalComments) ? $totalComments : '0' @endphp0
                                                    </td>

                                                    <td class="text-center">
                                                        @php //echo ($totalHelpful) ? $totalHelpful : '0' @endphp0
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-xs btn_white_table pr10">

                                                            @if ($data->status == 1)
                                                                <i class="icon-primitive-dot txt_green"></i> Publish
                                                            @elseif ($data->status == 2) 
                                                                <i class="icon-primitive-dot txt_red"></i> Pause
                                                            @elseif ($data->status == 3)
                                                                <i class="icon-primitive-dot txt_red"></i> Archive
                                                            @else
                                                                <i class="icon-primitive-dot txt_red"></i> Draft
                                                            @endif
                                                        </button>
                                                    </td>

                                                    <td>
                                                        @if ($user_role != '2')
                                                            @if ($currentUserId == $user_id || $user_role == 1)
                                                                <div class="tdropdown">
                                                                    <button type="button" class="btn btn-xs plus_icon ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
                                                                    <ul class="dropdown-menu dropdown-menu-right width-200">                                                                        
                                                                        @if ($data->status == 1) 
                                                                            <li>
                                                                                <a href="javascript:void(0);" class="changeStatusCampaign" widgetID="{{ $data->id }}" status="2"><i class="icon-file-stats"></i> Pause</a>
                                                                            </li>
                                                                        @endif
                                                                        @if ($data->status == 2) 
                                                                            <li>
                                                                                <a href="javascript:void(0);" class="changeStatusCampaign" widgetID="{{ $data->id }}" status="1"><i class="icon-file-stats"></i> Start</a>
                                                                            </li>
                                                                        @endif
                                                                        <li>
                                                                            <a href="{{ base_url('admin/brandboost/onsite_widget_setup/' . $data->id) }}" widgetID="{{ $data->id }}" b_title="{{ $data->brand_title }}" class="text-default text-semibold"><i class="icon-pencil"></i>  Edit</a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="javascript:void(0);" class="deleteCampaign" widgetID="{{ $data->id }}"><i class="icon-trash"></i> Delete</a>
                                                                        </li>
                                                                        
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="archiveCampaign" widgetID="{{ $data->id }}"><i class="icon-file-text2"></i> Move to Archive</a>
                                                                        </li>
                                                                        
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="viewECode" widgetID="{{ $data->id }}"><i class="icon-file-locked"></i> Get Embedded Code</a>
                                                                        </li>
                                                                        
                                                                        <li>
                                                                            <a href="{{ base_url('admin/brandboost/onsite_widget_stats/' . $data->id) }}" target="_blank"><i class="icon-file-locked"></i> Statistics</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @else
                                                                {{ '-' }}
                                                            @endif
                                                        @endif
                                                    </td>

                                                </tr>
                                                @php
                                                $inc++;
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

            <!--===========TAB 2===========-->
            <div class="tab-pane" id="right-icon-tab1">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">{{ $iArchiveCount }} Onsite Widgets 2</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="javascript:void(0)"><i class="icon-calendar52"></i></a>
                                        <a href="javascript:void(0)" class="editArchiveDataList"><i class="icon-pencil"></i></a>
                                        <button id="deleteButtonBrandboostOnsiteWidgetA" style="display: none;" class="btn btn-xs custom_action_boxA"><i class="icon-trash position-left"></i> Delete</button>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body p0">
                                <table class="table datatable-basic datatable-sorting">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editArchiveAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAllA" ><span class="custmo_checkmark"></span></label></th>
                                            <th><i class="icon-stack-star"></i>Name</th>
                                            <th><i class="icon-stack-star"></i>Widget Type</th>
                                            <th><i class="icon-stack-star"></i>Onsite Campaign</th>
                                            <th><i class="icon-calendar"></i>Created</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Views</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Clicks</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Commented</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Helpful</th>
                                            <th><i class="fa fa-dot-circle-o"></i>Status</th>
                                            <th><i class="fa fa-dot-circle-o"></i>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                        $inc = 1;
                                        $aUser = getLoggedUser();
                                        $currentUserId = $aUser->id;
                                        foreach ($oWidgetsList as $data) {
                                            $wid = $data->id;
                                            $oStats = \App\Models\Admin\BrandboostModel::getBBWidgetStats($wid);
                                            //widget Stats related Data
                                            if (!empty($oStats)) {
                                                foreach ($oStats as $oStat) {
                                                    if ($oStat->track_type == 'view') {
                                                        $aViews1[] = $oStat;
                                                    }
                                                    if ($oStat->track_type == 'click') {
                                                        $aClicks1[] = $oStat;
                                                    }
                                                    if ($oStat->track_type == 'comment') {
                                                        $aComments1[] = $oStat;
                                                    }
                                                    if ($oStat->track_type == 'helpful') {
                                                        $aHelpful1[] = $oStat;
                                                    }
                                                }
                                            }
                                            $totalRecords = count($oStats);
                                            $totalViews = count($aViews1);
                                            $totalClicks = count($aClicks1);
                                            $totalComments = count($aComments1);
                                            $totalHelpful = count($aHelpful1);
                                            //End of Widget Stats related Data
                                            if ($data->status == 3) {
                                                $list_id = $data->id;
                                                $user_id = $data->user_id;
                                                $campaignImgArray = unserialize($data->campaignImg);
                                                $campaign_img = $campaignImgArray[0]['media_url'];

                                                if (empty($campaign_img)) {
                                                    $campaignImgSrc = base_url('assets/images/default_table_img2.png');
                                                    $imgSrc = base_url('assets/images/default_table_img2.png');
                                                } else {
                                                    $campaignImgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $campaign_img;
                                                    $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $campaign_img;
                                                }
                                                @endphp

                                                <tr id="append-{{ $data->id }}" class="selectedClassA">
                                                    <td style="display: none;">{{ date('m/d/Y', strtotime($data->created)) }}</td>
                                                    <td style="display: none;">{{ $data->id }}</td>
                                                    <td style="display: none;" class="editArchiveAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRowsA" id="chk{{ $data->id }}" value="{{ $data->id }}" ><span class="custmo_checkmark"></span></label></td>
                                                    <td>
                                                        <div class="media-left media-middle">
                                                            <a href="{{ base_url('admin/brandboost/onsite_widget_setup/' . $data->id) }}" widgetID="{{ $data->id }}" b_title="{{ $data->widget_title }}" class="text-default text-semibold">
                                                                <img src="{{ $imgSrc }}" class="img-circle img-xs br5" alt="Img"></a>
                                                        </div>
                                                        <div class="media-left">
                                                            <div class=""><a href="{{ base_url('admin/brandboost/onsite_widget_setup/' . $data->id) }}" widgetID="{{ $data->id }}" b_title="{{ $data->widget_title }}" class="text-default text-semibold">{{ $data->widget_title }}</a></div>
                                                            <div class="text-muted text-size-small">
                                                                {!! setStringLimit($data->widget_desc) !!}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        @if ($data->widget_type == 'cpw')
                                                            {{ 'Center Popup' }}
                                                        @elseif ($data->widget_type == 'vpw') 
                                                            {{ 'Vertical Popup' }}
                                                        @elseif ($data->widget_type == 'bww')
                                                            {{ 'Button Widget Popup' }}
                                                        @elseif ($data->widget_type == 'bfw')
                                                            {{ 'Bottom Fixed Popup' }}
                                                        @else
                                                            <span style="font-size:11px;">[No Data]</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if (!empty($data->brandboost_id))
                                                            <div class="media-left media-middle">
                                                                <a href="{{ base_url('admin/brandboost/onsite_setup/' . $data->brandboost_id) }}" class="text-default text-semibold">
                                                                    <img src="{{ $campaignImgSrc }}" class="img-circle img-xs br5" alt="Img">
                                                                </a>
                                                            </div>
                                                            <div class="media-left">
                                                                <a href="{{ base_url("admin/brandboost/onsite_setup/" . $data->brandboost_id) }}" target="_blank">
                                                        @endif
                                                                {!! ($data->bbBrandTitle) ? $data->bbBrandTitle : '<span style="font-size:11px;">[No Data]</span>' !!}
                                                        @if (!empty($data->brandboost_id)): 
                                                                </a>
                                                                <div class="text-muted text-size-small">
                                                                    {!! setStringLimit($data->bbBrandDesc) !!}
                                                                </div>    
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="media-left">
                                                            <div class="pt-5"><span class="text-default text-semibold">{{ dataFormat($data->created) }}</span></div>
                                                            <div class="text-muted text-size-small">{{ date('h:i A', strtotime($data->created)) }}</div>
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        {{ ($totalViews) ? $totalViews : '0' }}
                                                    </td>

                                                    <td class="text-center">
                                                        {{ ($totalClicks) ? $totalClicks : '0' }}
                                                    </td>

                                                    <td class="text-center">
                                                        {{ ($totalComments) ? $totalComments : '0' }}
                                                    </td>

                                                    <td class="text-center">
                                                        {{ ($totalHelpful) ? $totalHelpful : '0' }}
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-xs btn_white_table pr10">

                                                            @if ($data->status == 1) 
                                                                <i class="icon-primitive-dot txt_green"></i> Publish
                                                            @elseif ($data->status == 2) 
                                                                <i class="icon-primitive-dot txt_red"></i> Pause
                                                            @elseif ($data->status == 3)
                                                                <i class="icon-primitive-dot txt_red"></i> Archive
                                                            @else
                                                                <i class="icon-primitive-dot txt_red"></i> Draft
                                                            @endif
                                                        </button>
                                                    </td>

                                                    <td>
                                                        @if ($user_role != '2') {
                                                            @if ($currentUserId == $user_id || $user_role == 1)
                                                                <div class="tdropdown">
                                                                    <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
                                                                    <ul class="dropdown-menu dropdown-menu-right width-200">

                                                                        @if ($canWrite != FALSE)
                                                                            @if ($data->status == 1) 
                                                                                <li>
                                                                                    <a href="javascript:void(0);" class="changeStatusCampaign" widgetID="{{ $data->id }}" status="2"><i class="icon-file-stats"></i> Pause</a>
                                                                                </li>
                                                                            @endif
                                                                            @if ($data->status == 2)
                                                                                <li>
                                                                                    <a href="javascript:void(0);" class="changeStatusCampaign" widgetID="{{ $data->id }}" status="1"><i class="icon-file-stats"></i> Start</a>
                                                                                </li>
                                                                            @endif
                                                                            <li>
                                                                                <a href="{{ base_url('admin/brandboost/onsite_widget_setup/' . $data->id) }}" widgetID="{{ $data->id }}" b_title="{{ $data->brand_title }}" class="text-default text-semibold"><i class="icon-pencil"></i>  Edit</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:void(0);" class="deleteCampaign" widgetID="{{ $data->id }}"><i class="icon-trash"></i> Delete</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{ base_url('admin/brandboost/onsite_widget_stats/' . $data->id) }}" target="_blank"><i class="icon-file-locked"></i> Statistics</a>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>                                                                
                                                            @else
                                                                {{ '-' }}
                                                            @endif
                                                        @endif
                                                    </td>

                                                </tr>
                                                @php
                                                $inc++;
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

            {-- @include('admin.brandboost.campaign-tabs.widget.onsite-widget-stats', array('statsType' => '')) --} 
        @else
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">{{ $iActiveCount }} Onsite Widgets 3</h6>
                                <div class="heading-elements">

                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="javascript:void(0)"><i class="icon-calendar52"></i></a>
                                        <a href="javascript:void(0)" class="editDataList"><i class="icon-pencil"></i></a>
                                        <button id="deleteButtonBrandboostOnlineWidget" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                                        <button id="archiveButtonOnsiteWidget" class="btn btn-xs custom_action_box"><i class="icon-gear position-left"></i> Archive</button>
                                    </div>

                                </div>
                            </div>

                            <div class="panel-body p0">
                                <table class="table datatable-basic datatable-sorting">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th><i class="icon-stack-star"></i>Name</th>
                                            <th><i class="icon-stack-star"></i>Widget Type</th>
                                            <th><i class="icon-stack-star"></i>Onsite Campaign</th>
                                            <th><i class="icon-calendar"></i>Created</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Views</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Clicks</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Commented</th>
                                            <th class="text-center"><i class="icon-stack-star"></i>Helpful</th>
                                            <th><i class="fa fa-dot-circle-o"></i>Status</th>
                                            <th><i class="fa fa-dot-circle-o"></i>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="12">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div style="margin: 20px 0px 0;" class="text-center">
                                                            <h5 class="mb-20 mt40">
                                                                Looks Like You Don't Have Any Brand Boosts Widget Yet <img src="{{ base_url('assets/images/smiley.png') }}"> <br>
                                                                Lets Create Your First Onsite Brand Boost Widget.
                                                            </h5>

                                                            @if ($canWrite)
                                                                <button 
                                                                    @if ($bActiveSubsription == false)
                                                                        title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription mb40" 
                                                                    @else
                                                                        id="addBrandboostWidgetShow" class="btn bl_cust_btn btn-default dark_btn ml20 mb40" 
                                                                    @endif 
                                                                    type="button" >
                                                                    <i class="icon-plus3"></i> Add On Site Widget
                                                                </button>
                                                            @endif

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

        @endif

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
                <div class="col-md-12" id="embeddedCode" style="border:1px #ccc solid; padding:10px; margin:0 5px 10px;"></div>
            </div>
            <hr>
            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<div id="addBrandboostWidgetModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddOnsiteBrandboostWidget" id="frmAddOnsiteBrandboostWidget" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Onsite Widget</h5>
                </div>

                <div class="modal-body">
                    <p>Please Enter Title below:</p>
                    <input class="form-control" id="campaignName" name="campaignName" placeholder="Enter Title" type="text" required>
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

        $(document).on('click', '#deleteButtonBrandboostOnlineWidget', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
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
                                    url: "{{ base_url('admin/brandboost/delete_multipal_brandboost_widget') }}",
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
                            }
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

        $(document).on('click', '#deleteButtonBrandboostOnsiteWidgetA', function () {

            var val = [];
            $('.checkRowsA:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
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
                                    url: "{{ base_url('admin/brandboost/delete_multipal_brandboost_widget') }}",
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
                            }
                        });
            }
        });


        $(document).on('click', '#archiveButtonOnsiteWidget', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to move to archive this record!",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, move to archive it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: "{{ base_url('admin/brandboost/archive_multipal_brandboost_widget') }}",
                                    type: "POST",
                                    data: {multi_brandboost_widget_id: val, _token: '{{csrf_token()}}'},
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
            }
        });

        $(document).on('click', '.archiveCampaign', function () {
            var widgetID = $(this).attr('widgetID');
            var val = [widgetID];

            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to move to archive this record!",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, move to archive it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: "{{ base_url('admin/brandboost/archive_multipal_brandboost_widget') }}",
                                    type: "POST",
                                    data: {multi_brandboost_widget_id: val, _token: '{{csrf_token()}}'},
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
            }
        });

        $('#addBrandboostWidget').click(function () {
            $('#addBrandboostWidgetModal').modal();
        });

        $(document).on('click', '#addBrandboostWidgetShow', function () {
            $("#addBrandboostWidget").trigger('click');
        });

        $('#frmAddOnsiteBrandboostWidget').on('submit', function (e) {
            $('.overlaynew').show();
            var campaignName = $('#campaignName').val();
            $.ajax({
                url: "{{ base_url('admin/brandboost/addOnsiteWidget') }}",
                type: "POST",
                data: {'campaignName': campaignName, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '{{ base_url() }}admin/brandboost/onsite_widget_setup/' + data.widgetID;
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
                url: "{{ base_url('admin/brandboost/updateOnsiteWidgetStatus') }}",
                type: "POST",
                data: {'widgetID': widgetID, 'status': status, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = "{{ base_url('admin/brandboost/widgets') }}";
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
                    function () {
                        $('.overlaynew').show();
                        var widgetID = $(elem).attr('widgetID');
                        $.ajax({
                            url: "{{ base_url('admin/brandboost/delete_brandboost_widget') }}",
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
                url: "{{ base_url('admin/brandboost/getOnsiteWidgetEmbedCode') }}",
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

        $(document).on('click', '.editArchiveDataList', function () {
            $('.editArchiveAction').toggle();
        });

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });

        $('[data-toggle="tooltip"]').tooltip();

    });

</script>
@endsection
