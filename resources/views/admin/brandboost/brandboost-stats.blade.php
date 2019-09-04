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
            <div class="col-md-6">
                <h3><i class="icon-star-half"></i> Brandboost Stats : {{ $title }}</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active" ><a href="#right-icon-tab0" data-toggle="tab">Email Stats</a></li>
                    <li class="" ><a href="#right-icon-tab1" data-toggle="tab">SMS Stats</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-6 text-right btn_area">
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
                            <h6 class="panel-title"> <span class="totalEmaiCount"></span> Email Stats</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body p0">
                            @php
                            $isValidated = true;
                            $eventNo = 0;
                            @endphp
                            <table class="table datatable-basic datatable-sorting">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th><i class="icon-display"></i>Campaign Subject</th>
                                        <th><i class="icon-calendar"></i>Created</th>
                                        <th><i class="icon-atom"></i>Processed</th>
                                        <th><i class="icon-atom"></i>Delivered</th>
                                        <th><i class="icon-atom"></i>Open</th>
                                        <th><i class="icon-atom"></i>Click</th>
                                        <th><i class="icon-user"></i>Unsubscribe</th>
                                        <th><i class="icon-atom"></i>Bounce</th>
                                        <th><i class="icon-atom"></i>Dropped</th>
                                        <th><i class="icon-atom"></i>Spam Report</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    foreach ($oEvents as $oEvent) {
                                        $isSMSAdded = $isEmailAdded = false;
                                        $oCampaignData = getCampaignsByEventID($oEvent->id);
                                        $oCampaigns = $oCampaignData[0];

                                        if (!empty($oCampaigns->campaign_type) && $oCampaigns->campaign_type == 'Email') {

                                            $eventNo++;
                                            $aFollowupTriggerData = json_decode($oEvent->data);
                                            $bAnyEventExist = true;
                                            //Display Emails & Stats

                                            $isSMSAdded = true;

                                            $aStats = $this->mBrandboost->getSendgridStats('campaign', $oCampaigns->id);
                                            $aCategorizedStats = $this->mBrandboost->getSendgridCategorizedStatsData($aStats);
                                            //pre($aCategorizedStats);

                                            $processed = $aCategorizedStats['processed']['UniqueCount'];
                                            $delivered = $aCategorizedStats['delivered']['UniqueCount'];
                                            $open = $aCategorizedStats['open']['UniqueCount'];
                                            $click = $aCategorizedStats['click']['UniqueCount'];
                                            $unsubscribe = $aCategorizedStats['unsubscribe']['UniqueCount'];
                                            $bounce = $aCategorizedStats['bounce']['UniqueCount'];
                                            $dropped = $aCategorizedStats['dropped']['UniqueCount'];
                                            $spamReport = $aCategorizedStats['spam_report']['UniqueCount'];

                                            $deliveredGraph = $delivered * 100 / $processed;
                                            $openGraph = $open * 100 / $processed;
                                            $clickGraph = $click * 100 / $processed;
                                            $unsubscribeGraph = $unsubscribe * 100 / $processed;
                                            $bounceGraph = $bounce * 100 / $processed;
                                            $droppedGraph = $dropped * 100 / $processed;
                                            $spamReportGraph = $spamReport * 100 / $processed;
                                            //pre($oCampaigns);
                                            @endphp
                                            <tr>
                                                <td style="display: none;">{{ date('m/d/Y', strtotime($oEvent->created)) }}</td>
                                                <td style="display: none;">{{ $oEvent->id }}</td>
                                                <td>
                                                    <div class="media-left media-middle"> 
                                                        <a class="icons square" href="#"><i class="icon-indent-decrease2 txt_blue"></i></a> 
                                                    </div>
                                                    <div class="media-left">
                                                        <div><a href="#" class="text-default text-semibold">{!! $oCampaigns->subject == '' ? '<span style="color:#999999">No Data</span>' : setStringLimit($oCampaigns->subject) !!}</a></div>
                                                        <div class="text-muted text-size-small">{{ setStringLimit($oCampaigns->name) }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', strtotime($oEvent->created)) }}</a></div>
                                                        <div class="text-muted text-size-small">{{ date('h:i A', strtotime($oEvent->created)) }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $processed }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $processed }} Processed Email">
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $processed }}" aria-valuemin="0" aria-valuemax="{{ $processed }}" style="width:{{ $processed > 0 ? '100' : 0 }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $delivered }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $delivered }} Delivered Email">
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $processed }}" aria-valuemin="0" aria-valuemax="{{ $delivered }}" style="width:{{ $deliveredGraph }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $open }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $open }} Open Email">
                                                        <div class="progress-bar progress-bar-green2" role="progressbar" aria-valuenow="{{ $open }}" aria-valuemin="0" aria-valuemax="{{ $open }}" style="width:{{ $openGraph }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $click }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $click }} Click">
                                                        <div class="progress-bar progress-bar-green2" role="progressbar" aria-valuenow="{{ $click }}" aria-valuemin="0" aria-valuemax="{{ $click }}" style="width:{{ $clickGraph }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $unsubscribe }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $unsubscribe }} Unsubscribe">
                                                        <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="{{ $unsubscribe }}" aria-valuemin="0" aria-valuemax="{{ $unsubscribe }}" style="width:{{ $unsubscribeGraph }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $bounce }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $bounce }} Bounce Email">
                                                        <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="{{ $bounce }}" aria-valuemin="0" aria-valuemax="{{ $bounce }}" style="width:{{ $bounceGraph }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $dropped }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $dropped }} Dropped Email">
                                                        <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="{{ $dropped }}" aria-valuemin="0" aria-valuemax="{{ $dropped }}" style="width:{{ $droppedGraph }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $spamReport }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $spamReport }} Spam Email">
                                                        <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="{{ $spamReport }}" aria-valuemin="0" aria-valuemax="{{ $spamReport }}" style="width:{{ $spamReportGraph }}%"></div>
                                                    </div>
                                                </td>

                                            </tr>@php
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
                            <h6 class="panel-title"><span class="totalSMSCount"></span> SMS Stats </h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="panel-body p0">
                            <table class="table datatable-basic datatable-sorting">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th><i class="icon-display"></i>Campaign Subject</th>
                                        <th><i class="icon-calendar"></i>Created</th>
                                        <th><i class="icon-atom"></i>Sent Sms</th>
                                        <th><i class="icon-atom"></i>Delivered Sms</th>
                                        <th><i class="icon-atom"></i>Accepted Sms</th>
                                        <th><i class="icon-atom"></i>Failed Sms</th>
                                        <th><i class="icon-atom"></i>Queued Sms</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    foreach ($oEvents as $oEvent) {
                                        $isSMSAdded = $isEmailAdded = false;
                                        $oCampaignData = getCampaignsByEventID($oEvent->id);
                                        $oCampaigns = $oCampaignData[0];
                                        if (!empty($oCampaigns->campaign_type) && $oCampaigns->campaign_type == 'SMS') {

                                            $eventNo++;
                                            $aFollowupTriggerData = '';
                                            $aFollowupTriggerData = json_decode($oEvent->data);


                                            $bAnyEventExist = true;
                                            //Display Emails & Stats

                                            $isSMSAdded = true;


                                            $aStatsSms = $this->mBrandboost->getTwilioStats('campaign', $oCampaigns->id);
                                            $aCategorizedStatsSms = $this->mBrandboost->getTwilioCategorizedStatsData($aStatsSms);

                                            $sentSms = $aCategorizedStatsSms['sent']['UniqueCount'];
                                            $deliveredSms = $aCategorizedStatsSms['delivered']['UniqueCount'];
                                            $acceptedSms = $aCategorizedStatsSms['accepted']['UniqueCount'];
                                            $failedSms = $aCategorizedStatsSms['failed']['UniqueCount'];
                                            $queuedSms = $aCategorizedStatsSms['queued']['UniqueCount'];

                                            $deliveredSmsGraph = $deliveredSms * 100 / $sentSms;
                                            $acceptedSmsGraph = $acceptedSms * 100 / $sentSms;
                                            $failedSmsGraph = $failedSms * 100 / $sentSms;
                                            $queuedSmsGraph = $queuedSms * 100 / $sentSms;
                                            //pre($oCampaigns);
                                            @endphp
                                            <tr>
                                                <td style="display: none;">{{ date('m/d/Y', strtotime($oEvent->created)) }}</td>
                                                <td style="display: none;">{{ $oEvent->id }}</td>
                                                <td>
                                                    <div class="media-left media-middle"> 
                                                        <a class="icons square" href="#"><i class="icon-indent-decrease2 txt_blue"></i></a> 
                                                    </div>
                                                    <div class="media-left">
                                                        <div><a href="#" class="text-default text-semibold">{!! $oCampaigns->subject == '' ? '<span style="color:#999999">No Data</span>' : setStringLimit($oCampaigns->subject) !!}</a></div>
                                                        <div class="text-muted text-size-small">{{ setStringLimit($oCampaigns->name) }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', strtotime($oEvent->created)) }}</a></div>
                                                        <div class="text-muted text-size-small">{{ date('h:i A', strtotime($oEvent->created)) }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $sentSms }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $sentSms }} Sent SMS">
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $sentSms }}" aria-valuemin="0" aria-valuemax="{{ $sentSms }}" style="width:{{ $sentSms > 0 ? '100' : 0 }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $deliveredSms }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $deliveredSms }} Delivered SMS">
                                                        <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="{{ $deliveredSms }}" aria-valuemin="0" aria-valuemax="{{ $deliveredSms }}" style="width:{{ $deliveredSmsGraph }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $acceptedSms }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $acceptedSms }} Accepted SMS">
                                                        <div class="progress-bar progress-bar-green2" role="progressbar" aria-valuenow="{{ $acceptedSms }}" aria-valuemin="0" aria-valuemax="{{ $acceptedSms }}" style="width:{{ $acceptedSmsGraph }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $failedSms }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $failedSms }} Failed SMS">
                                                        <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="{{ $failedSms }}" aria-valuemin="0" aria-valuemax="{{ $failedSms }}" style="width:{{ $failedSmsGraph }}%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold">{{ $queuedSms }}</a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total {{ $queuedSms }} Queued SMS">
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $queuedSms }}" aria-valuemin="0" aria-valuemax="{{ $queuedSms }}" style="width:{{ $queuedSmsGraph }}%"></div>
                                                    </div>
                                                </td>

                                            </tr>@php
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
</div>
<!-- /content area -->
<script>
    showTotalRecord('DataTables_Table_0_info', 'totalEmaiCount');
    showTotalRecord('DataTables_Table_1_info', 'totalSMSCount');
</script>
@endsection