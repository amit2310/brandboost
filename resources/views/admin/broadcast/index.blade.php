@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
@php
$iActiveCount = $iArchiveCount = 0;

if (!empty($oBroadcast)) {
    foreach ($oBroadcast as $oCount) {
        if ($oCount->bc_status == 'archive') {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}

$newOpen = $newClick = 0;
@endphp
<style>
    .createSegment{
        cursor:pointer!important;
    }
</style>
<!-- Content area -->

<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><img src="/assets/images/email_icon_active.png"> @php if ($campaignType == 'Email'): @endphp Email Broadcasts@php else: @endphp SMS Broadcast@php endif; @endphp</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <!--                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Brand Boost Broadcast</a></li>
                                        <li><a href="#right-icon-tab1" data-toggle="tab">Archive</a></li>-->
                    <li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="">All</a></li>
                    <li class=""><a style="javascript:void();" class="filterByColumn" fil="active">Active</a></li>
                    <li class=""><a style="javascript:void();" class="filterByColumn" fil="expired">Expired</a></li>
                    <li class=""><a style="javascript:void();" class="filterByColumn" fil="draft">Draft</a></li>
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

                @if (strtolower($campaignType) == 'email')
                    <button type="button" class="btn bl_cust_btn new btn-default addBroadcast dark_btn ml20" broadcast_type="Email"><i class="icon-plus3"></i> &nbsp; Email Broadcast</button> 
                @endif
                @if (strtolower($campaignType) == 'sms')
                    <button type="button" class="btn bl_cust_btn new btn-default addBroadcast dark_btn ml20" broadcast_type="SMS"><i class="icon-plus3"></i> &nbsp; SMS Broadcast</button>
              @endif
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
    @php if (!empty($oBroadcast)): @endphp
        <div class="tab-content"> 
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <span class="pull-left">
                                    <h6 class="panel-title">Broadcast</h6>
                                </span>

                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableid="emailsmsbroadcast" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_search.png" width="14"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_refresh.png"></i></a>
                                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_calender.png"></i></a>
                                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_download.png"></i></a>
                                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_upload.png"></i></a>
                                        <a href="javascript:void(0);"><i class="editDataList"><img src="<?php echo base_url(); ?>assets/images/icon_edit.png"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" title="delete" id="deleteButtonBroadcast" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" title="archive" id="archiveButtonBroadcast" class="custom_action_box"><i class="icon-gear position-left"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table" id="emailsmsbroadcast">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_star_10.png"/></i>Broadcast Name</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_click_10.png"/></i>Schedule Time</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_minus.png"></i>Sent</th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_view.png"></i><?php echo (strtolower($campaignType) == 'email') ? 'Opens' : 'Delivered'; ?></th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_click_10.png"></i>@php echo (strtolower($campaignType) == 'email') ? 'Clicked' : 'Queued'; @endphp</th>
                                            <th><i class=""><img src="{{ base_url() }} assets/images/icon_click_10.png"></i>Sending Method</th>
                                            <th class="text-right"><i><img src="{{ base_url() }}assets/images/icon_date.png"></i>Created</th>
                                            <th class=""><i class="fa fa-dot-circle-o"></i>Status</th>
                                            <th class="text-center" ><i class="fa fa-dot-circle-o"></i>Action</th>
                                            <th style="display:none;">status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        foreach ($oBroadcast as $broadCastData) {
                                            $aDeliveryParam = json_decode($broadCastData->data);
                                            $deliveryDate = $aDeliveryParam->delivery_date;
                                            $deliveryTime = $aDeliveryParam->delivery_time;
                                            $timeString = $deliveryDate . ' ' . $deliveryTime;
                                            $deliverAt = strtotime($timeString);

                                            $gmt_date = strtotime(gmdate('Y-m-d H:i:s', time()));
                                            $estTime = date("Y-m-d H:i:s", ($gmt_date - 14400));
                                            $timeNow = strtotime($estTime);
                                            $bExpired = false;
                                            if ($timeNow > $deliverAt) {
                                                $bExpired = true;
                                            }

                                            //if ($broadCastData->bc_status != 'archive') {
                                            if (1) {
                                                $totalSentGraph = 0;
                                                $totalOpenGraph = 0;
                                                $totalClickGraph = 0;
                                                $totalQueuedGraph = 0;
                                                $totalDeliveredGraph = 0;
                                                $queued = $open = $click = 0;
                                                $newQueue = $newSent = $newDelivered = 0;

                                                if (strtolower($broadCastData->campaign_type) == 'email') {
                                                    if ($broadCastData->sending_method == 'split') {
                                                        $aStats = $mBroadcast->getBroadcastSendgridStats('broadcast', $broadCastData->broadcast_id, '', 'split');
                                                        //pre($aStats);
                                                    } else {
                                                        $aStats = $mBroadcast->getBroadcastSendgridStats('broadcast', $broadCastData->broadcast_id);
                                                    }

                                                    $aCategorizedStats = $mBroadcast->getBroadcastSendgridCategorizedStatsData($aStats);
                                                    //pre($aCategorizedStats);

                                                    $totalSent = $aCategorizedStats['processed']['UniqueCount'];
                                                    $delivered = $aCategorizedStats['delivered']['UniqueCount'];
                                                    $open = $aCategorizedStats['open']['UniqueCount'];
                                                    $click = $aCategorizedStats['click']['UniqueCount'];

                                                    if ($totalSent > 0) {
                                                        $totalSentGraph = $delivered * 100 / $totalSent;
                                                        $totalSentGraph = ceil($totalSentGraph);
                                                    }
                                                } else {
                                                    
                                                    if ($broadCastData->sending_method == 'split') {
                                                        $aStatsSms = $mBroadcast->getBroadcasstTwilioStats('broadcast', $broadCastData->broadcast_id, '', 'split');
                                                    } else {
                                                        $aStatsSms = $mBroadcast->getBroadcasstTwilioStats('broadcast', $broadCastData->broadcast_id);
                                                    }

                                                    $aCategorizedStatsSms = $mBroadcast->getBroadcastTwilioCategorizedStatsData($aStatsSms);

                                                    $totalSent = $aCategorizedStatsSms['sent']['UniqueCount'];
                                                    $delivered = $aCategorizedStatsSms['delivered']['UniqueCount'];
                                                    $queued = $aCategorizedStatsSms['queued']['UniqueCount'];
                                                    $open = $aCategorizedStatsSms['accepted']['UniqueCount'];
                                                    if ($totalSent > 0) {
                                                        $totalDeliveredGraph = $delivered * 100 / $totalSent;
                                                        $totalDeliveredGraph = ceil($totalDeliveredGraph);

                                                        $totalSentGraph = $totalSent * 100 / $totalSent;
                                                        $totalSentGraph = ceil($totalSentGraph);

                                                        $totalQueuedGraph = $queued * 100 / $totalSent;
                                                        $totalQueuedGraph = ceil($totalQueuedGraph);
                                                    }
                                                }

                                                if ($broadCastData->sending_method == 'split') {
                                                    $totalVariations = 0;
                                                    $oVariations = $mBroadcast->getBroadcastVariations($broadCastData->broadcast_id);
                                                    $totalVariations = count($oVariations);
                                                }


                                                if ($totalSent > 0) {
                                                    $totalOpenGraph = $open * 100 / $totalSent;
                                                    $totalOpenGraph = ceil($totalOpenGraph);

                                                    $totalClickGraph = $click * 100 / $totalSent;
                                                    $totalClickGraph = ceil($totalClickGraph);
                                                }
                                                @endphp
                                                <tr id="append-<?php echo $broadCastData->broadcast_id; ?>" class="selectedClass">
                                                    <td style="display: none;">{{ date('m/d/Y', strtotime($broadCastData->created)) }}</td>
                                                    <td style="display: none;">{{ $broadCastData->broadcast_id }}</td>
                                                    <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk {{ $broadCastData->broadcast_id }} ?>" value="{{ $broadCastData->broadcast_id }} " ><span class="custmo_checkmark"></span></label></td>
                                                    <td>
                                                        <div class="media-left media-middle pl-5"> <a class="icons br5" href="#"><img src="{{ base_url() }}assets/images/@php echo (strtolower($broadCastData->campaign_type) == 'email') ? 'icon_massages.png' : 'icon_sms_24.png'; @endphp" class="img-circle img-xs br5" alt=""></a> </div>
                                                        <div class="media-left">
                                                            <div class=""><a href="@php echo base_url('admin/broadcast/edit/' . $broadCastData->broadcast_id); @endphp" broadcast_id="{{ $broadCastData->broadcast_id }}" broadcast_title="{{ $broadCastData->title }}" broadcast_des="{{ $broadCastData->description }}" class="text-default text-semibold">{{ setStringLimit($broadCastData->title, 20) }}</a></div>
                                                            <div class="text-muted text-size-small">
                                                                {{ setStringLimit($broadCastData->description, 25) }}
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        @php dataFormat(date("Y-m-d H:i:s", $deliverAt)) . ' <span class="txt_grey">' . date("H:i A", $deliverAt) . '</span>' @endphp
                                                    </td>
                                                    @php if (strtolower($broadCastData->campaign_type) == 'email'): @endphp
                                                        <td>
                                                            @php
                                                            $addPC = '';
                                                            if ($totalSentGraph > 50) {
                                                                $addPC = 'over50';
                                                            }
                                                            @endphp
                                                            <div class="media-left">
                                                                <div class="progress-circle {{ $addPC }} blue3 cp {{ $totalSentGraph }} @php if ($delivered > 0): @endphp createSegment @php endif;@endphp" segment-type="total-sent" campaign-id="{{ $broadCastData->broadcast_id }}" campaign-type="email" sending_method="{{ $broadCastData->sending_method }}" title="click to create segment">
                                                                    <div class="left-half-clipper">
                                                                        <div class="first50-bar"></div>
                                                                        <div class="value-bar"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="media-left">
                                                                <div data-toggle="tooltip" title="{{ $delivered }} sent out of {{ $totalSent @php echo strtolower($broadCastData->campaign_type) == 'email' ? 'emails' : 'sms'; @endphp" data-placement="top">
                                                                    @php
                                                                    if ($totalSentGraph > 0) {
                                                                        @endphp
                                                                        <a href="<?php echo base_url(); ?>admin/broadcast/records/<?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'email' : 'sms'; ?>/<?php echo $broadCastData->broadcast_id; ?>?type=delivered" class="text-default text-semibold"><?php echo $delivered; ?></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $delivered; ?></a>
                                                                    <?php }
                                                                    ?>
                                                                    <?php if ($newOpen > 0): ?>    
                                                                        <?php echo '<span style="color:#FF0000;"> (' . $newOpen . ' new)</span>'; ?>    
                                                                    <?php endif; ?>    

                                                                </div>
                                                            </div>

                                                        </td>

                                                        <td>
                                                            <?php
                                                            $addPC = '';
                                                            if ($totalOpenGraph > 50) {
                                                                $addPC = 'over50';
                                                            }
                                                            ?>
                                                            <div class="media-left">
                                                                <div class="progress-circle <?php echo $addPC; ?> blue1 cp<?php echo $totalOpenGraph; ?> <?php if ($open > 0): ?>createSegment<?php endif; ?>" segment-type="total-open" campaign-id="<?php echo $broadCastData->broadcast_id; ?>" campaign-type="email" sending_method="<?php echo $broadCastData->sending_method; ?>" title="click to create segment">
                                                                    <div class="left-half-clipper">
                                                                        <div class="first50-bar"></div>
                                                                        <div class="value-bar"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="media-left">
                                                                <div data-toggle="tooltip" title="<?php echo $open; ?> open out of <?php echo $totalSent; ?> <?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'emails' : 'sms'; ?>" data-placement="top">
                                                                    <?php
                                                                    if ($open > 0) {
                                                                        ?>
                                                                        <a href="<?php echo base_url(); ?>admin/broadcast/records/<?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'email' : 'sms'; ?>/<?php echo $broadCastData->broadcast_id; ?>?type=open" class="text-default text-semibold"><?php echo $open; ?></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $open; ?></a>
                                                                    <?php }
                                                                    ?>
                                                                    <?php if ($newOpen > 0): ?>    
                                                                        <?php echo '<span style="color:#FF0000;"> (' . $newOpen . ' new)</span>'; ?>    
                                                                    <?php endif; ?>    

                                                                </div>
                                                            </div>

                                                        </td>
                                                    <?php else: ?>

                                                        <td>
                                                            <?php
                                                            $addPC = '';
                                                            if ($totalSentGraph > 50) {
                                                                $addPC = 'over50';
                                                            }
                                                            ?>
                                                            <div class="media-left">
                                                                <div class="progress-circle <?php echo $addPC; ?> blue3 cp<?php echo $totalSentGraph; ?> <?php if ($totalSent > 0): ?>createSegment<?php endif; ?>"  segment-type="total-sent" campaign-id="<?php echo $broadCastData->broadcast_id; ?>" campaign-type="sms" sending_method="<?php echo $broadCastData->sending_method; ?>" title="click to create segment">
                                                                    <div class="left-half-clipper">
                                                                        <div class="first50-bar"></div>
                                                                        <div class="value-bar"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="media-left">
                                                                <div data-toggle="tooltip" title="<?php echo $totalSent; ?> sent out of <?php echo $totalSent; ?> <?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'emails' : 'sms'; ?>" data-placement="top">
                                                                    <?php
                                                                    if ($totalSentGraph > 0) {
                                                                        ?>
                                                                        <a href="<?php echo base_url(); ?>admin/broadcast/records/<?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'email' : 'sms'; ?>/<?php echo $broadCastData->broadcast_id; ?>?type=sent" class="text-default text-semibold"><?php echo $totalSent; ?></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $delivered; ?></a>
                                                                    <?php }
                                                                    ?>
                                                                    <?php if ($newSent > 0): ?>    
                                                                        <?php echo '<span style="color:#FF0000;"> (' . $newSent . ' new)</span>'; ?>    
                                                                    <?php endif; ?>    

                                                                </div>
                                                            </div>

                                                        </td>

                                                        <td>
                                                            <?php
                                                            $addPC = '';
                                                            if ($totalDeliveredGraph > 50) {
                                                                $addPC = 'over50';
                                                            }
                                                            ?>
                                                            <div class="media-left">
                                                                <div class="progress-circle <?php echo $addPC; ?> blue1 cp<?php echo $totalDeliveredGraph; ?> <?php if ($delivered > 0): ?>createSegment<?php endif; ?>" segment-type="total-delivered" campaign-id="<?php echo $broadCastData->broadcast_id; ?>" campaign-type="sms" sending_method="<?php echo $broadCastData->sending_method; ?>" title="click to create segment">
                                                                    <div class="left-half-clipper">
                                                                        <div class="first50-bar"></div>
                                                                        <div class="value-bar"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="media-left">
                                                                <div data-toggle="tooltip" title="<?php echo $delivered; ?> delivered out of <?php echo $totalSent; ?> <?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'emails' : 'sms'; ?>" data-placement="top">
                                                                    <?php
                                                                    if ($delivered > 0) {
                                                                        ?>
                                                                        <a href="<?php echo base_url(); ?>admin/broadcast/records/<?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'email' : 'sms'; ?>/<?php echo $broadCastData->broadcast_id; ?>?type=delivered" class="text-default text-semibold"><?php echo $delivered; ?></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $delivered; ?></a>
                                                                    <?php }
                                                                    ?>
                                                                    <?php if ($newDelivered > 0): ?>    
                                                                        <?php echo '<span style="color:#FF0000;"> (' . $newDelivered . ' new)</span>'; ?>    
                                                                    <?php endif; ?>    

                                                                </div>
                                                            </div>

                                                        </td>

                                                    <?php endif; ?>
                                                    <?php if (strtolower($campaignType) == 'email'): ?>
                                                        <td>
                                                            <?php
                                                            $addPC = '';
                                                            if ($totalClickGraph > 50) {
                                                                $addPC = 'over50';
                                                            }
                                                            ?>
                                                            <div class="media-left">
                                                                <div class="progress-circle <?php echo $addPC; ?> blue2 cp<?php echo $totalClickGraph; ?> <?php if ($click > 0): ?>createSegment<?php endif; ?>" segment-type="total-click" campaign-id="<?php echo $broadCastData->broadcast_id; ?>" campaign-type="email" sending_method="<?php echo $broadCastData->sending_method; ?>" title="click to create segment">
                                                                    <div class="left-half-clipper">
                                                                        <div class="first50-bar"></div>
                                                                        <div class="value-bar"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="media-left">
                                                                <div data-toggle="tooltip" title="<?php echo $click; ?> click out of <?php echo $totalSent; ?> <?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'emails' : 'sms'; ?>" data-placement="top">
                                                                    <?php
                                                                    if ($click > 0) {
                                                                        ?>
                                                                        <a href="<?php echo base_url(); ?>admin/broadcast/records/<?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'email' : 'sms'; ?>/<?php echo $broadCastData->broadcast_id; ?>?type=click" class="text-default text-semibold"><?php echo $click; ?></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $click; ?></a>
                                                                    <?php }
                                                                    ?>
                                                                    <?php if ($newClick > 0): ?>    
                                                                        <?php echo '<span style="color:#FF0000;"> (' . $newClick . ' new)</span>'; ?>    
                                                                    <?php endif; ?>    

                                                                </div>
                                                            </div>

                                                        </td>
                                                    <?php else: ?>
                                                        <td>
                                                            <?php
                                                            $addPC = '';
                                                            if ($totalQueuedGraph > 50) {
                                                                $addPC = 'over50';
                                                            }
                                                            ?>
                                                            <div class="media-left">
                                                                <div class="progress-circle <?php echo $addPC; ?> blue2 cp<?php echo $totalQueuedGraph; ?> <?php if ($click > 0): ?>createSegment<?php endif; ?>" segment-type="total-queued" campaign-id="<?php echo $broadCastData->broadcast_id; ?>" campaign-type="sms" sending_method="<?php echo $broadCastData->sending_method; ?>" title="click to create segment">
                                                                    <div class="left-half-clipper">
                                                                        <div class="first50-bar"></div>
                                                                        <div class="value-bar"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="media-left">
                                                                <div data-toggle="tooltip" title="<?php echo $queued; ?> click out of <?php echo $totalSent; ?> <?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'emails' : 'sms'; ?>" data-placement="top">
                                                                    <?php
                                                                    if ($queued > 0) {
                                                                        ?>
                                                                        <a href="<?php echo base_url(); ?>admin/broadcast/records/<?php echo strtolower($broadCastData->campaign_type) == 'email' ? 'email' : 'sms'; ?>/<?php echo $broadCastData->broadcast_id; ?>?type=queued" class="text-default text-semibold"><?php echo $queued; ?></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $click; ?></a>
                                                                    <?php }
                                                                    ?>
                                                                    <?php if ($newQueue > 0): ?>    
                                                                        <?php echo '<span style="color:#FF0000;"> (' . $newQueue . ' new)</span>'; ?>    
                                                                    <?php endif; ?>    

                                                                </div>
                                                            </div>

                                                        </td>
                                                    <?php endif; ?>
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url(); ?>admin/broadcast/report/<?php echo $broadCastData->broadcast_id; ?>">
                                                            <?php echo ($broadCastData->sending_method == 'split') ? 'Split(' . $totalVariations . ' Variations)' : 'Normal'; ?>
                                                        </a>    
                                                    </td>
                                                    <td class="text-right"><div class="media-left text-right pull-right">
                                                            <div class=""><a href="#" class="text-default text-semibold"><?php echo dataFormat($broadCastData->created); ?> <span class="txt_grey"><?php echo dataFormatHours($broadCastData->created); ?></span></a> </div>
                                                        </div></td>
                                                        <!-- <td>
                                                    <?php
                                                    $oParams = json_decode($broadCastData->data);

                                                    $deliveryDate = $oParams->delivery_date;
                                                    $deliveryTime = $oParams->delivery_time;
                                                    $timeString = $deliveryDate . ' ' . $deliveryTime;  //08/31/2017 1:05 AM
                                                    $deliverAt = strtotime($timeString);

                                                    $timeNow = strtotime(date("h:i A"));
                                                    if ($deliverAt > $timeNow && $broadCastData->bc_status == 'active') {
                                                        echo '<span class="label bkg_blue" title="To be sent on ' . dataFormat(date("Y-m-d H:i:s", $deliverAt)) . ' ' . dataFormatHours("Y-m-d H:i:s", $deliverAt) . '">Schedule</span>';
                                                    } else if ($deliverAt < $timeNow && $broadCastData->bc_status == 'active') {
                                                        echo '<span class="label bkg_green" title="Sent on ' . dataFormat(date("Y-m-d H:i:s", $deliverAt)) . ' ' . dataFormatHours("Y-m-d H:i:s", $deliverAt) . '">Sent</span>';
                                                    } else {
                                                        echo '<span class="label bkg_red">Disabled</span>';
                                                    }
                                                    ?>

                                                        </td> -->



                                                    <td class="">
                                                        <?php
                                                        if ($broadCastData->bc_status == 'active') {
                                                            if ($bExpired == true) {
                                                                echo '<i class="icon-primitive-dot txt_grey3 fsize16"></i> ';
                                                            } else {
                                                                echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
                                                            }
                                                        } else {
                                                            echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                                                        }
                                                        ?>
                                                        <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                                                            <?php
                                                            if ($broadCastData->bc_status == 'active') {
                                                                if ($bExpired == true) {
                                                                    echo 'Expired';
                                                                } else {
                                                                    echo 'Active';
                                                                }
                                                            } else if ($broadCastData->bc_status == 'draft') {
                                                                echo 'Draft';
                                                            } else {
                                                                //echo 'Inactive';
                                                                echo ucfirst($broadCastData->bc_status);
                                                            }
                                                            ?>

                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right status">

                                                        </ul>
                                                    </td>



                                                    <td class="text-center">
                                                        <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                                                            <ul class="dropdown-menu dropdown-menu-right more_act">
                                                                <li><a href="{{ base_url() }}admin/broadcast/edit/<?php echo $broadCastData->broadcast_id; ?>"><i class="icon-pencil"></i> Edit</a></li>
                                                                <li><a href="javascript:void(0);" class="clonBroadcastCampaign" broadcast_id="<?php echo $broadCastData->broadcast_id; ?>"><i class="icon-file-stats"></i> Duplicate</a></li>
                                                                <?php if ($broadCastData->bc_status != 'archive'): ?>
                                                                    <li><a href="javascript:void(0);" class="moveArchive" broadcast_id="<?php echo $broadCastData->broadcast_id; ?>"><i class="icon-file-stats"></i> Move To Archive</a></li>
                                                                <?php endif; ?>
                                                                <li><a href="javascript:void(0);" class="deleteBroadcastCampaign" broadcast_id="<?php echo $broadCastData->broadcast_id; ?>"><i class="icon-trash"></i> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>

                                                    <td style="display:none;">
                                                        <?php
                                                        if ($broadCastData->bc_status == 'archive') {
                                                            echo 'archive';
                                                        } else if ($broadCastData->bc_status == 'draft') {
                                                            echo 'draft';
                                                        } else {
                                                            if ($bExpired == true) {
                                                                echo 'expired';
                                                            } else {
                                                                echo 'active';
                                                            }
                                                        }
                                                        ?>
                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    @php else: @endphp

        <div class="tab-content"> 
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title"><?php echo $iActiveCount; ?> Brand Boost Broadcast</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>&nbsp; &nbsp;

                                    <button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
                                    <button id="deleteButtonBroadcast" class="btn custom_action_box btn-xs">Delete</button>
                                    <button id="archiveButtonBroadcast" class="btn custom_action_box btn-xs">Archive</button>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic" id="">
                                    <thead>
                                        <tr>
                                            <th><i class="icon-stack-star"></i>Broadcast Name</th>
                                            <th><i class="icon-envelop"></i>Type</th>
                                            <th><i class="icon-calendar"></i>Created</th>
                                            <th><i class="icon-envelop2"></i>Total</th>
                                            <th><i class="fa fa-smile-o fsize12"></i>Opens</th>
                                            <th><i class="fa fa-smile-o fsize12"></i>Clicks</th>
                                            <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                                            <th class="text-center" ><i class="fa fa-dot-circle-o"></i>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td colspan="11">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="margin: 20px 0px 0;" class="text-center">

                                                            <h5 class="mb-20 mt40">
                                                                Looks Like You Don't Have Created Any <?php echo $campaignType; ?> Broadcast Yet <img src="<?php echo site_url('assets/images/smiley.png'); ?>"> <br>
                                                                Lets Create <?php echo $campaignType; ?> Broadcast.
                                                            </h5>


                                                            <button type="button" class="btn bl_cust_btn new btn-default addBroadcast dark_btn ml20 mb40" broadcast_type="<?php echo $campaignType; ?>"><i class="icon-plus3"></i> &nbsp; <?php echo $campaignType; ?> Broadcast</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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

    @php endif @endphp 

</div>

<!-- Add Segment Popup -->
<div id="addSegment" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="addBroadcastSegment" id="addBroadcastSegment" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> Add Segment &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
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
                    <input type="hidden" value="Email" name="sendingMethod" id="hidSendingMethod">

                    <input type="hidden" value="<?php echo $moduleName; ?>" name="moduleName" />

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
                    <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/<?php echo ($campaignType == 'Email') ? 'Email_Color.svg' : 'Sms_Color.svg'; ?>"/> Add Brand Boost Broadcast &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
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
                    <input type="hidden" value="<?php echo ($campaignType == 'Email') ? 'Email' : 'SMS'; ?>" name="broadCastType" id="broadCastType">
                    <button data-toggle="modal" type="submit" class="btn dark_btn <?php echo ($campaignType == 'Email') ? 'bkg_sblue' : 'bkg_green' ?> fsize14 h52">Continue</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>


<!-- /Add Broadcast -->		

<!-- Update Broadcast Modal-->
<div id="updateBroadcast" class="modal fade">
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
</div>
<!-- /Add Broadcast -->	
<script>

    $(document).ready(function () {

        $('#emailsmsbroadcast thead tr').clone(true).appendTo('#emailsmsbroadcast thead');

        $('#emailsmsbroadcast thead tr:eq(1) th').each(function (i) {

            //console.log(i);
            if (i === 12) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatus">');

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

        var tableId = 'emailsmsbroadcast';
        var tableBase = custom_data_table(tableId);

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
                                    url: '<?php echo base_url('admin/modules/emails/multipalDeleteAutomation'); ?>',
                                    type: "POST",
                                    data: {_token: '{{csrf_token()}}', multipal_automation_id: val},
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
                                    url: '<?php echo base_url('admin/modules/emails/multipalDeleteAutomation'); ?>',
                                    type: "POST",
                                    data: {_token: '{{csrf_token()}}', multipal_automation_id: val},
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


        $(document).on('click', '#archiveButtonBroadcast', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {
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
                                    url: '<?php echo base_url('admin/broadcast/multipalArchiveAutomation'); ?>',
                                    type: "POST",
                                    data: {_token: '{{csrf_token()}}', multipal_automation_id: val},
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
                url: '<?php echo base_url('admin/broadcast/clonBroadcastCampaign'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', automation_id: automationID},
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
            var automationID = $(this).attr('broadcast_id');
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/moveArchive'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', automation_id: automationID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = window.location.href;
                    }
                }
            });
        });

        $(document).on('click', '.deleteBroadcastCampaign', function () {
            var elem = $(this);

            deleteConfirmationPopup(
                    "This record will deleted immediately.<br>You can't undo this action.",
                    function () {
                        $('.overlaynew').show();
                        var automationID = $(elem).attr('broadcast_id');
                        $.ajax({
                            url: '<?php echo base_url('admin/modules/emails/deleteAutomation'); ?>',
                            type: "POST",
                            data: {_token: '{{csrf_token()}}', automation_id: automationID},
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
                    url: '<?php echo base_url('admin/broadcast/updateBroadcastClone'); ?>',
                    type: "POST",
                    data: {_token: '{{csrf_token()}}', edit_broadcastId: broadcastId, campaign_name: campaignName, description: description},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            window.location.href = '<?php echo base_url('admin/broadcast/edit/'); ?>' + broadcastId;
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
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/createBroadcast'); ?>',
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'campaign_name': campaignName, 'template_name': campaignTemplateID, 'description': description, 'template_content': campaignTemplateContant, 'broadcast_type': broadCastType},
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
            var campaignType = $(this).attr('campaign-type');
            var sendingMethod = $(this).attr('sending_method');
            $("#hidSegmentCampaignID").val(campaignID);
            $("#hidSegmentType").val(segmentType);
            $("#hidCampaignType").val(campaignType);
            $("#hidSendingMethod").val(sendingMethod);
            $("#addSegment").modal("show");
        });

        $('#addBroadcastSegment').submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            var tkn = $('meta[name="_token"]').attr('content');
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/createSegment'); ?>',
                type: "POST",
                data: formData + '&_token=' + tkn,
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

    });
</script>

@endsection