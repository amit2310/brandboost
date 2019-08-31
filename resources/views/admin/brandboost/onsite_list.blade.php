@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')

@php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign') @endphp
@php
$iActiveCount = $iArchiveCount = 0;

if (!empty($aBrandbosts)) {
    foreach ($aBrandbosts as $oCount) {
        if ($oCount->status == 3) {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}
error_reporting(0);
@endphp

<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            @if($viewstats == true)
                    
                <div class="col-md-3">
                   <h3><img src="{{ base_url() }}assets/images/onsite_icons.png"> On Site Overview</h3>
                   <ul class="nav nav-tabs nav-tabs-bottom">
                       <li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="1|0|2">Active Campaigns</a></li>
                       <li><a style="javascript:void();" class="filterByColumn" fil="3">Archive</a></li>
                   </ul>
               </div>
               @else
                <div class="col-md-3">
                   <h3><img src="{{ base_url() }}assets/images/onsite_icons.png"> On Site Review Campaigns</h3>
                   <ul class="nav nav-tabs nav-tabs-bottom">
                       <li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="1|0|2">Active Campaigns</a></li>
                       <li><a style="javascript:void();" class="filterByColumn" fil="3">Archive</a></li>
                   </ul>
               </div>
            @endif
           
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Campaign &nbsp; &nbsp; <span class="caret"></span>
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

                @if ($user_role != 1)
                    @if ($canWrite)
                        <button @if ($bActiveSubsription == false) title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription" @else id="addBrandboost" class="btn bl_cust_btn btn-default dark_btn ml20" @endif type="button" ><i class="icon-plus3"></i> Add On Site Review Campaign</button>
                    @endif
                @endif

            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
   
    @if (!empty($aBrandbosts))
        <div class="tab-content"> 
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">

                @if($viewstats == true)
                    {{--@include('admin.brandboost.campaign-tabs.onsite.overview_stats') --}}
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <span class="pull-left">
                                    <h6 class="panel-title">{{ $iActiveCount }} On Site Review Campaigns</h6>
                                </span>
                                <div class="heading_links pull-left">
                                    <a class="top_links btn btn-xs btn_white_table ml20 top_links_all">All</a>
                                    <a class="top_links top_links_Status" getValue="1" style="cursor: pointer;">Active</a>
                                    <a class="top_links top_links_Status" getValue="0" style="cursor: pointer;">Inactive</a> 
                                    <a class="top_links top_links_positive" getValue="positive" style="cursor: pointer;">Positive</a> 
                                    <a class="top_links top_links_neutral" getValue="neutral" style="cursor: pointer;">Neutral</a> 
                                    <a class="top_links top_links_negative" getValue="negative" style="cursor: pointer;">Negative</a> 
                                    <a class="top_links top_links_added_today"  getValue="today" style="cursor: pointer;">Added Today</a>
                                </div>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableID="onsiteBrandboostCampaign" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="javascript:void(0);"><i class="icon-calendar52"></i></a>
                                        <a href="javascript:void(0);" class="editDataList"><i class="icon-pencil"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" id="deleteButtonBrandboostOnline" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" id="archiveButtonBrandboostOnline" class="custom_action_box"><i class="icon-gear position-left"></i></a>
                                    </div>				
                                </div>

                            </div>

                            <div class="panel-body p0">
                                <table class="table datatable-basic-new" id="onsiteBrandboostCampaign">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/star_name.png"/></i>Name</th>
                                            <th><i class="icon-star-full2"></i>Rating</th>
                                            <th><i class="icon-calendar"></i>Created</th>
                                            <th><i class="icon-user"></i> Contacts</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/emoji_smile.png"/></i> Positive</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/emoji_smile2.png"/></i> Neutral</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/emoji_smile3.png"/></i> Negative</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/clock.png"/></i>Last review</th>
                                            <th><i class="icon-diff-modified"></i>Status</th>
                                            <th style="display: none;">status</th>
                                            <th style="display: none;">status</th>
                                            <th style="display: none;">Positive</th>
                                            <th style="display: none;">Neutral</th>
                                            <th style="display: none;">Negative</th>
                                            <th style="display: none;">Today</th>
                                            <th><i class="icon-calendar"></i>Last Incoming Lead</th>
                                            <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                        $recent = strtotime('-24 hours');
                                        $aUser = getLoggedUser();
                                        $currentUserId = $aUser->id;
                                        foreach ($aBrandbosts as $data) {
                                        
                                            //if ($data->status == 1 or $data->status == 0 or $data->status == 2) {
                                            $list_id = $data->id;
                                            $user_id = $data->user_id;
                                            $revCount = getCampaignReviewCount($data->id);
                                            $revRA = getCampaignReviewRA($data->id);
                                            $allSubscribers = \App\Models\Admin\ListsModel::getAllSubscribersList($data->id);

                                            $newContacts = 0;
                                            $iActiveContactCount = 0;
                                            $iArchiveCount = 0;
                                            $subs = '';
                                            if (!empty($allSubscribers)) {
                                                $subs = $allSubscribers[0];
                                                foreach ($allSubscribers as $oSubs) {
                                                    if(strtotime($oSubs->created)> $recent){
                                                        $newContacts++;
                                                    }
                                                    if ($oSubs->status == 2) {
                                                        $iArchiveCount++;
                                                    } else {
                                                        $iActiveContactCount++;
                                                    }
                                                }
                                            }

                                            if(!empty($subs->s_created)) {
                                                $lastListTime = timeAgo($subs->s_created);
                                            }
                                            else {
                                                $lastListTime = '<div class="media-left">
                                                          <div class="">
                                                            <span class="text-muted text-size-small">[No Data]</span></div>
                                                        </div>';
                                            }

                                            $siteRevCount = getCampaignSiteReviewCount($data->id);
											$siteRevCount = 1;
                                            $siteRevRA = getCampaignSiteReviewRA($data->id);
                                            
                                            $siteRevRA = 1;

                                            $imgSrc = base_url('assets/images/default_table_img2.png');
                                           
                                            $reviewRequests = \App\Models\Admin\BrandboostModel::getReviewRequest($data->id, '');
                                            $getSendRequest = count($reviewRequests);
                                            $getSendRequestSms = getSendRequest($data->id, 'sms');
                                            $getSendRequestEmail = getSendRequest($data->id, 'email');
                                            $getSendRequestEmailPersentage = $getSendRequestEmail * 100 / $getSendRequest;
                                            $getSendRequestSmsPersentage = $getSendRequestSms * 100 / $getSendRequest;

                                            $reviewResponse = \App\Models\Admin\BrandboostModel::getReviewRequestResponse($data->id);
                                            $getResCount = count($reviewResponse);
											
                                            $getSendRequest = $getSendRequest > 0 ? $getSendRequest : 1;
                                            $getResCount = $getResCount > 0 ? $getResCount : 1;
                                            
                                            $positiveRating = 0;
                                            $neturalRating = 0;
                                            $negativeRating = 0;
                                            $positiveGraph = 0;
                                            $neturalGraph = 0;
                                            $negativeGraph = 0;
                                            
                                            $newPositive = $newNegative = $newNeutral = 0;
                                            foreach ($reviewResponse as $reviewData) {
                                                
                                                if ($reviewData->ratings != '') {
                                                    if ($reviewData->ratings >= 4) {
                                                        if(strtotime($reviewData->reviewdate)>$recent){
                                                            $newPositive++;
                                                        }
                                                        $positiveRating++;
                                                    } else if ($reviewData->ratings == 3) {
                                                        if(strtotime($reviewData->reviewdate)>$recent){
                                                            $newNeutral++;
                                                        }
                                                        $neturalRating++;
                                                    } else {
                                                        if(strtotime($reviewData->reviewdate)>$recent){
                                                            $newNegative++;
                                                        }
                                                        $negativeRating++;
                                                    }
                                                }
                                                $reviewUserData = \App\Models\Admin\UsersModel::getUserInfo($reviewData->user_id);
                                            }

                                            $positiveGraph = $positiveRating * 100 / $getResCount;
                                            $neturalGraph = $neturalRating * 100 / $getResCount;
                                            $negativeGraph = $negativeRating * 100 / $getResCount;
                                            $totalGraph = $getResCount * 100 / $getSendRequest;
                                            $totalGraph = $totalGraph > 100 ? 100 : $totalGraph;

                                            
                                            @endphp

                                            <tr id="append-{{ $data->id }}" class="selectedClass">
                                                <td style="display: none;">{{ date('m/d/Y', strtotime($data->created)) }}</td>
                                                <td style="display: none;">{{ $data->id }}</td>
                                                <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk{{ $data->id }}" value="{{ $data->id }}" ><span class="custmo_checkmark"></span></label></td>

                                                <td>
                                                    <div class="media-left media-middle">
                                                        <a href="{{ base_url('admin/brandboost/onsite_setup/' . $data->id) }}" brandID="{{ $data->id }}" b_title="{{ $data->brand_title }}">
                                                            <img src="{{ $imgSrc }}" class="img-circle img-xs br5" alt="Img"></a>
                                                    </div>
                                                    <div class="media-left">
                                                        <div class=""><a href="{{ base_url('admin/brandboost/onsite_setup/' . $data->id) }}" brandID="{{ $data->id }}" b_title="{{ $data->brand_title }}" class="text-default text-semibold">{{ $data->brand_title }}</a></div>
                                                        <div class="text-muted text-size-small">
                                                            {!! setStringLimit($data->brand_desc, 28) !!}
                                                        </div>
                                                    </div>

                                                </td>

                                                <td>
                                                    {!! ratingView($revRA) !!}
                                                </td>
                                                <td>														
                                                    <div class="media-left">
                                                        <div class=""><span class="text-default text-semibold">{{ date('F dS Y', strtotime($data->created)) }}</span></div>
                                                        <div class="text-muted text-size-small">{{ date('h:i A', strtotime($data->created)) }}</div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div data-toggle="tooltip" title="Total contacts {{ sizeof($allSubscribers) }}" data-placement="top">
                                                        <a href="{{ base_url('admin/brandboost/onsite_setup/' . $data->id . '?t=Clients') }}"  class="text-default text-semibold">{{ sizeof($allSubscribers) }} @if($newContacts>0) {{ '<span style="color:#FF0000;"> ('.$newContacts.' new)</span>' }} @endif </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    @php
                                                    $positiveGraph = ceil($positiveGraph);
                                                    $addPC = '';
                                                    if ($positiveGraph > 50) {
                                                        $addPC = 'over50';
                                                    }
                                                    @endphp
                                                    <div class="media-left">
                                                        <div class="progress-circle {{ $addPC }} green cp{{ $positiveGraph }} @if ($positiveGraph > 0) createSegment @endif" segment-type="total-positive" campaign-id="{{ $data->id }}" campaign-type="email" title="click to create segment">
                                                            <div class="left-half-clipper">
                                                                <div class="first50-bar"></div>
                                                                <div class="value-bar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-left">
                                                        <div data-toggle="tooltip" title="{{ $positiveRating }} out of {{ $getResCount }} Responses" data-placement="top">
                                                            @if ($positiveRating > 0) 
                                                                <a href="{{ base_url('admin/brandboost/onsite_setup/' . $data->id . '?cate=positive') }}" class="text-default text-semibold">{{ $positiveRating }}</a>
                                                            @else
                                                                <a href="javascript:void(0);" class="text-default text-semibold">{{ $positiveRating }}</a>
                                                            @endif
                                                            @if($newPositive>0)    
                                                            {{ '<span style="color:#FF0000;"> ('.$newPositive.' new)</span>' }}   
                                                            @endif    

                                                        </div>
                                                    </div>

                                                </td>
                                                <td>

                                                    @php
                                                    $neturalGraph = ceil($neturalGraph);
                                                    $addNUC = '';
                                                    if ($neturalGraph > 50) {
                                                        $addNUC = 'over50';
                                                    }
                                                    @endphp
                                                    <div class="media-left">
                                                        <div class="progress-circle {{ $addNUC }} grey cp{{ $neturalGraph }} @if ($neturalGraph > 0) createSegment @endif" segment-type="total-neutral" campaign-id="{{ $data->id }}" campaign-type="email" title="click to create segment">
                                                            <div class="left-half-clipper">
                                                                <div class="first50-bar"></div>
                                                                <div class="value-bar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-left">
                                                        <div data-toggle="tooltip" title="{{ $neturalRating }} out of {{ $getResCount }} Response" data-placement="top">
                                                            @if ($neturalRating > 0)
                                                                <a  href="{{ base_url('admin/brandboost/onsite_setup/' . $data->id . '?cate=neutral') }}" class="text-default text-semibold">
                                                                {{ $neturalRating }}
                                                                </a>
                                                            @else     
                                                            <a href="javascript:void(0);" class="text-default text-semibold">{{ $neturalRating }}</a>
                                                            @endif
                                                            @if($newNeutral>0)
                                                                {{ '<span style="color:#FF0000;"> ('.$newNeutral.' new)</span>' }}    
                                                            @endif
                                                        </div>
                                                    </div>

                                                </td>
                                                <td>

                                                    @php
                                                    $negativeGraph = ceil($negativeGraph);
                                                    $addNEC = '';
                                                    if ($negativeGraph > 50) {
                                                        $addNEC = 'over50';
                                                    }
                                                    @endphp
                                                    <div class="media-left">
                                                        <div class="progress-circle {{ $addNEC }} red cp{{ $negativeGraph }} @if ($negativeGraph > 0) createSegment @endif" segment-type="total-negative" campaign-id="{{ $data->id }}" campaign-type="email" title="click to create segment">
                                                            <div class="left-half-clipper">
                                                                <div class="first50-bar"></div>
                                                                <div class="value-bar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-left">
                                                        <div data-toggle="tooltip" title="{{ $negativeRating }} out of {{ $getResCount }} Response" data-placement="top">
                                                            @if ($negativeRating > 0) 
                                                            <a  href="{{ base_url('admin/brandboost/onsite_setup/' . $data->id . '?cate=negative') }}" class="text-default text-semibold">
                                                                {{ $negativeRating }}</a>
                                                            @else
                                                            <a href="javascript:void(0);" class="text-default text-semibold">{{ $negativeRating }}</a>
                                                            @endif
                                                            @if($newNegative>0)
                                                            {{ '<span style="color:#FF0000;"> ('.$newNegative.' new)</span>' }}   
                                                            @endif  
                                                        </div> 
                                                    </div> 

                                                </td>
                                                <td>
                                                    @if (sizeof($reviewResponse) < 1) 
                                                        {!! displayNoData(true) !!}
                                                    @else
                                                        <div class="media-left media-middle"> <img src="{{ smilyRating($reviewResponse[0]->ratings) }}" class="img-circle" width="26" alt=""> </div>
                                                        <div class="media-left">
                                                            <div class=""><a href="#" class="text-default text-semibold">{{ number_format($reviewResponse[0]->ratings, 1) }} </a> </div>
                                                            <div class="text-muted text-size-small">{{ $reviewUserData->firstname }}</div>
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="tdropdown">
                                                        @php
                                                        if ($data->status == 0) {
                                                            echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                                                        } else if ($data->status == 2) {
                                                            echo '<i class="icon-primitive-dot txt_grey fsize16"></i> ';
                                                        } else if ($data->status == 3) {
                                                            echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                                                        } else {
                                                            echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
                                                        }
                                                        @endphp
                                                        <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                                                        @php
                                                        if ($data->status == 0) {
                                                            echo 'Inactive';
                                                        } else if ($data->status == 2) {
                                                            echo 'Pending';
                                                        } else if ($data->status == 3) {
                                                            echo 'Archive';
                                                        } else {
                                                            echo 'Active';
                                                        }
                                                        @endphp

                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right status">

                                                        </ul>
                                                    </div>
                                                </td>


                                                <td style="display: none;">{{ $data->status }}</td>
                                                <td style="display: none;">{{ $data->status }}</td>
                                                <td style="display: none;">{{ $positiveRating > 0 ? 'positive' : '' }}</td>
                                                <td style="display: none;">{{ $neturalRating > 0 ? 'neutral' : '' }}</td>
                                                <td style="display: none;">{{ $negativeRating > 0 ? 'negative' : '' }}</td>
                                                <td style="display: none;">
                                                     {{ date('d M y', strtotime($data->created)) === date('d M y') ? 'today' : '' }}
                                                </td>
                                                <td>{!! $lastListTime !!}</td>
                                                <td class="text-center">

                                                    @php
                                                    if ($user_role != '2') {
                                                        if ($currentUserId == $user_id || $user_role == 1) {

                                                            if ($data->status == 1 or $data->status == 0 or $data->status == 2) {
                                                                @endphp
                                                                <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ base_url() }}assets/images/more.svg"></a>
                                                                    <ul class="dropdown-menu dropdown-menu-right more_act">

                                                                        @if ($canWrite != FALSE)
                                                                            @if ($data->status == 1)
                                                                                <li><a href="javascript:void(0);" class="changeStatusCampaign" brandID="{{ $data->id }}" status="2"><i class="icon-file-stats"></i> Pause</a></li>
                                                                            @endif
                                                                            @if ($data->status == 2)
                                                                                <li><a href="javascript:void(0);" class="changeStatusCampaign" brandID="{{ $data->id }}" status="1"><i class="icon-file-stats"></i> Start</a></li>
                                                                            @endif
                                                                            <li><a href="{{ base_url('admin/brandboost/onsite_setup/' . $data->id) }}" brandID="{{ $data->id }}" b_title="{{ $data->brand_title }}" class="text-default text-semibold"><i class="icon-pencil"></i>  Edit</a></li>
                                                                            
                                                                            <li><a href="javascript:void(0);" class="deleteCampaign" brandID="{{ $data->id }}"><i class="icon-trash"></i> Delete</a></li>
                                                                            <li><a href="javascript:void(0);" class="archiveCampaign" brandID="{{ $data->id }}"><i class="icon-file-text2"></i> Move to Archive</a></li>
                                                                        @endif
                                                                        <li><a href="{{ base_url('admin/brandboost/stats/onsite/' . $data->id . '?t=contact') }}" target="_blank"><i class="icon-gear"></i> Contacts</a></li>
                                                                        <li>@php $companyName = strtolower(str_replace(' ', '-', $company_name)) @endphp<a href="{{ base_url('for/'.$companyName.'/') }}{{ strtolower(str_replace(" ", "-", $data->brand_title)) . '-' . $data->id }}" target="_blank"><i class="icon-menu"></i>Campaign Page</a></li> 
                                                                        <li><a href="{{ base_url('admin/brandboost/reviews/' . $data->id) }}" target="_blank"><i class="icon-menu"></i>Reviews</a></li> <li><a href="{{ base_url('admin/questions/view/' . $data->id) }}" target="_blank"><i class="icon-menu"></i>Question</a></li>
                                                                    </ul>
                                                                </div>
                                                                @php
                                                            } else {
                                                                @endphp
                                                                <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ base_url() }}assets/images/more.svg"></a>
                                                                    <ul class="dropdown-menu dropdown-menu-right more_act">
                                                                        <li><a href="{{ base_url('admin/brandboost/onsite_setup/' . $data->id) }}" brandID="{{ $data->id }}" b_title="{{ $data->brand_title }}" class="text-default text-semibold"><i class="icon-pencil"></i>  Edit</a></li>
                                                                        <li><a href="javascript:void(0);" class="deleteCampaign" brandID="{{ $data->id }}"><i class="icon-trash"></i> Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                                                @php
                                                                        }
                                                                } else {
                                                                        echo '-';
                                                                }
                                                        }
                                                        @endphp														
                                                </td>
                                            </tr>
                                                @php
                                                //}
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
                                    <span class="pull-left">
                                        <h6 class="panel-title">{{ $iActiveCount }} On Site Review Campaigns</h6>
                                    </span>
                                    <div class="heading_links pull-left">
                                        <a class="top_links btn btn-xs btn_white_table ml20 top_links_all">All</a>
                                        <a class="top_links top_links_Status" getValue="1" style="cursor: pointer;">Active</a>
                                        <a class="top_links top_links_Status" getValue="0" style="cursor: pointer;">Inactive</a> 
                                        <a class="top_links top_links_positive" getValue="positive" style="cursor: pointer;">Positive</a> 
                                        <a class="top_links top_links_neutral" getValue="neutral" style="cursor: pointer;">Neutral</a> 
                                        <a class="top_links top_links_negative" getValue="negative" style="cursor: pointer;">Negative</a> 
                                        <a class="top_links top_links_added_today"  getValue="today" style="cursor: pointer;">Added Today</a>
                                    </div>
                                    <div class="heading-elements">
                                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                            <div class="form-control-feedback">
                                                <i class="icon-search4"></i>
                                            </div>
                                        </div>
                                        <div class="table_action_tool">
                                            <a href="javascript:void(0);"><i class="icon-calendar52"></i></a>
                                            <a href="javascript:void(0);" class="editDataList"><i class="icon-pencil"></i></a>
                                            <button id="deleteButtonBrandboostOnline" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                                            <button id="archiveButtonBrandboostOnline" class="btn btn-xs custom_action_box"><i class="icon-gear position-left"></i> Archive</button>
                                        </div>              
                                    </div>

                                </div>

                                <div class="panel-body p0">
                                    <table class="table datatable-basic">
                                        <thead>
                                            <tr>
                                                <th style="display: none"></th>
                                                <th style="display: none"></th>
                                                <th><i class=""><img src="{{ base_url() }}assets/images/star_name.png"/></i>Name</th>
                                                <th><i class="icon-star-full2"></i>Rating</th>
                                                <th><i class="icon-calendar"></i>Created</th>
                                                <th><i class="icon-user"></i> Contacts</th>
                                                <th><i class=""><img src="{{ base_url() }}assets/images/emoji_smile.png"/></i> Positive</th>
                                                <th><i class=""><img src="{{ base_url() }}assets/images/emoji_smile2.png"/></i> Neutral</th>
                                                <th><i class=""><img src="{{ base_url() }}assets/images/emoji_smile3.png"/></i> Negative</th>
                                                <th><i class=""><img src="{{ base_url() }}assets/images/clock.png"/></i>Last review</th>
                                                <th><i class="icon-diff-modified"></i>Status</th>
                                                <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>

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
                                                                Looks Like You Don’t Have Any On Site Review Campaign Yet <img src="{{ site_url('assets/images/smiley.png') }}"> <br>
                                                                Lets Create Your First On Site Review Campaign.
                                                            </h5>

                                                            @if ($canWrite)
                                                                <button @if ($bActiveSubsription == false)  title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription mb40" @else id="addBrandboost" class="btn bl_cust_btn btn-default dark_btn ml20 mb40" @endif type="button" ><i class="icon-plus3"></i> Add On Site Review Campaign</button>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
        </div>

    @endif
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


<!-- addBrandboost -->
<div id="addBrandboostModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
     <form method="post" name="frmAddOnsiteBrandboost" id="frmAddOnsiteBrandboost" action="javascript:void();">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h5 class="modal-title"><img src="/new_pages/assets/css/menu_icons/OffSiteBoost_Color.svg"/> Add On Site Review Campaign &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
        </div>
        <div class="modal-body">
         <h6 class="text-semibold">Step 1: Where Would You Like To Boost Your Brand? </h6>
          <div class="row">
          <div class="col-md-12">
          <div class="form-group">
          <label>Please Enter Title below:</label>
        <input class="form-control" id="campaignName" name="campaignName" placeholder="Enter Title" type="text" required>

          </div>
          
          <div class="form-group mb0">
          <label>Please Enter Description:</label>
          <input class="form-control h52" type="text" id="OnsitecampaignDescription" name="OnsitecampaignDescription" value="" placeholder="Enter list description"/>
          </div>
          </div>
          </div>
        </div>
        <div class="modal-footer">
        <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
          <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
          
        </div>
      </form>
    </div>
  </div>
</div>

@include('admin.modals.segments.segments-popup')
<script src="{{ base_url() }}assets/js/modules/segments/segments.js" type="text/javascript"></script>
                                                                            
<!-- /addBrandboost -->

<script type="text/javascript">


    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#onsiteBrandboostCampaign thead tr').clone(true).appendTo('#onsiteBrandboostCampaign thead');

        $('#onsiteBrandboostCampaign thead tr:eq(1) th').each(function (i) {


            if (i === 12) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="1|0|2" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatus">');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value, $('#colStatus').prop('checked', true))
                                .draw();
                    }
                });
            }

            if (i === 13) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterStatus" value="" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatusActive">');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value, $('#colStatusActive').prop('checked', true))
                                .draw();
                    }
                });
            }

            if (i === 14) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterPositive" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                    }
                });
            }

            if (i === 15) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterNeutral" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                    }
                });
            }

            if (i === 16) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterNegative" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                    }
                });
            }

            if (i === 17) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterAddedToday" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                    }
                });
            }

        });

        setTimeout(function () {
            $('#activeCampaign').trigger('click');
        }, 2000);


        $(document).on('click', '.filterByColumn', function () {

            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();

        });

        $(document).on('click', '.top_links_Status', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            var getStatus = $('#filterStatus').val();
            var statusArr = [];
            if ($(this).hasClass('btn_white_table')) {
                var findStatus = $(this).attr('getValue');
                statusArr = getStatus.split("|");
                var index = statusArr.indexOf(findStatus);
                if (index > -1) {
                    statusArr.splice(index, 1);
                }
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {

                var findStatus = $(this).attr('getValue');
                if (getStatus == '') {
                    statusArr.push(findStatus);
                } else {
                    statusArr = getStatus.split("|");
                    statusArr.push(findStatus);
                }

                $(this).addClass('btn btn-xs btn_white_table');
            }

            var newStatusArray = statusArr.join('|');
            $('#filterStatus').val(newStatusArray);
            $('#filterStatus').keyup();

            $('.top_links_all').removeClass('btn btn-xs btn_white_table');

        });

        $(document).on('click', '.top_links_all', function () {

            $('.heading_links').each(function (i) {
                $(this).children('a').removeClass('btn btn-xs btn_white_table');
            });
            $(this).addClass('btn btn-xs btn_white_table');
            //var findStatus = $(this).attr('getValue');

            $('#filterStatus').val('');
            $('#filterStatus').keyup();

            $('#filterPositive').val('');
            $('#filterPositive').keyup();

            $('#filterNeutral').val('');
            $('#filterNeutral').keyup();

            $('#filterNegative').val('');
            $('#filterNegative').keyup();

            $('#filterAddedToday').val('');
            $('#filterAddedToday').keyup();

        });


        $(document).on('click', '.top_links_positive', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterPositive').val(findValue);
            $('#filterPositive').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });

        $(document).on('click', '.top_links_neutral', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterNeutral').val(findValue);
            $('#filterNeutral').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });

        $(document).on('click', '.top_links_negative', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterNegative').val(findValue);
            $('#filterNegative').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });

        $(document).on('click', '.top_links_added_today', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterAddedToday').val(findValue);
            $('#filterAddedToday').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });


        var tableId = 'onsiteBrandboostCampaign';
        var tableBase = custom_data_table(tableId);

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

        $(document).on('click', '#deleteButtonBrandboostOnline', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
                "This campaign will deleted immediately.<br>You can't undo this action.", 
                function() {

                    $('.overlaynew').show();
                    $.ajax({
                        url: "{{ base_url('admin/brandboost/delete_multipal_brandboost') }}",
                        type: "POST",
                        data: {multi_brandboost_id: val, _token: '{{csrf_token()}}'},
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

        $(document).on('click', '#deleteButtonBrandboostOnlineA', function () {

            var val = [];
            $('.checkRowsA:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
                "This campaign will deleted immediately.<br>You can't undo this action.", 
                function() {

                    $('.overlaynew').show();
                    $.ajax({
                        url: "{{ base_url('admin/brandboost/delete_multipal_brandboost') }}",
                        type: "POST",
                        data: {multi_brandboost_id: val},
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


        $(document).on('click', '#archiveButtonBrandboostOnline', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                archiveConfirmationPopup(
                "This campaign will move to archive immediately.<br>You can't undo this action.", 
                function() {

                    $('.overlaynew').show();
                    $.ajax({
                        url: "{{ base_url('admin/brandboost/archive_multipal_brandboost') }}",
                        type: "POST",
                        data: {multi_brandboost_id: val, _token: '{{csrf_token()}}'},
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

        $(document).on('click', '.archiveCampaign', function () {
            var brandID = $(this).attr('brandID');
            var val = [brandID];

            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                archiveConfirmationPopup(
                "This campaign will move to archive immediately.<br>You can't undo this action.", 
                function() {

                    $('.overlaynew').show();
                    $.ajax({
                        url: "{{ base_url('admin/brandboost/archive_multipal_brandboost') }}",
                        type: "POST",
                        data: {multi_brandboost_id: val, _token: '{{csrf_token()}}'},
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

        $(document).on('click', '#addBrandboost', function () {
            $('#addBrandboostModal').modal();
        });

        $('#frmAddOnsiteBrandboost').on('submit', function (e) {
            $('.overlaynew').show();
            var campaignName = $('#campaignName').val();
            var OnsitecampaignDescription = $('#OnsitecampaignDescription').val();
                                                                            
            $.ajax({
                url: "{{ base_url('admin/brandboost/addOnsite') }}",
                type: "POST",
                data: {'campaignName': campaignName,'OnsitecampaignDescription':OnsitecampaignDescription, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '{{ base_url() }}admin/brandboost/onsite_setup/' + data.brandboostID;
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });


        $(document).on("click", ".changeStatusCampaign", function () {
            var brandboostID = $(this).attr('brandID');
            var status = $(this).attr('status');
            $.ajax({
                url: "{{ base_url('admin/brandboost/updateOnsiteStatus') }}",
                type: "POST",
                data: {'brandboostID': brandboostID, 'status': status, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = "{{ base_url('admin/brandboost/onsite') }}";
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on('click', '.deleteCampaign', function () {

            var brandID = $(this).attr('brandID');

            deleteConfirmationPopup(
            "This campaign will deleted immediately.<br>You can't undo this action.", 
            function() {

                $('.overlaynew').show();
                
                $.ajax({
                    url: "{{ base_url('admin/brandboost/delete_brandboost') }}",
                    type: "POST",
                    data: {brandboost_id: brandID, _token: '{{csrf_token()}}'},
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

        $(document).on('click', '.viewECode', function () {
            var brandID = $(this).attr('brandID');
            $.ajax({
                url: '{{ base_url('admin/brandboost/getBBECode') }}',
                type: "POST",
                data: {brandboost_id: brandID, _token: '{{csrf_token()}}'},
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
            $('#deleteButtonBrandboostOnlineA').toggle();
        });

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });

        $('[data-toggle="tooltip"]').tooltip();

    });
</script>
@endsection

