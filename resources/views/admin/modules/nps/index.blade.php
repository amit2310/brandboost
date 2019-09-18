@extends('layouts.main_template')

@section('title')
{{ $title }}
@endsection

@section('contents')

@php
	$iActiveCount = $iArchiveCount = 0;

	if (!empty($oPrograms)) {
		foreach ($oPrograms as $oCount) {
			if ($oCount->status == 'archive') {
				$iArchiveCount++;
			} else {
				$iActiveCount++;
			}
		}
	}
@endphp
<!-- Content area -->

<style type="text/css">
    .icons.fl_letters_gray { background: #7a8dae!important; opacity: 0.65; }
    span.icons.fl_letters_gray { width: 32px; height: 32px; box-shadow: none!important; background: #fff; text-align: center;    text-transform: uppercase; line-height: 32px; color: #fff; border-radius: 100px; font-size: 12px; font-weight: 500; display: block; }
</style>

<div class="content">
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><img style="width: 19px;" src="{{ base_url() }}assets/images/nps_icon.png"> &nbsp; NPS Surveys</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="active">Active NPS Surveys</a></li>
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
                <button @if ($bActiveSubsription == false) title="No Active Subscription" class="btn dark_btn ml20 pDisplayNoActiveSubscription" @else id="addNpsSurvery" @endif type="button" class="btn dark_btn ml20"><i class="icon-plus3"></i> Add New Survey</button>
            </div>
        </div>
    </div>

    <!-- Dashboard content -->

       @if ($oPrograms)
        <div class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">{{ $iActiveCount }} NPS Surveys</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>&nbsp; &nbsp;

                                    <div class="table_action_tool">
                                        <a href="javascript:void(0);"><i class="icon-calendar52"></i></a>
                                        <a href="javascript:void(0);" class="editDataList"><i class="icon-pencil"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" id="deleteBulkNPS" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" id="archiveBulkNPS" class="custom_action_box"><i class="icon-gear position-left"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body p0">
                                <table class="table datatable-basic-new" id="npsModules">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                            <th><i class="icon-stack-star"></i> Name</th>
                                            <th class="text-center"><i class="icon-star-full2"></i> NPS Score</th>
                                            <th><i class="icon-calendar"></i> Created</th>
                                            <th><i class="icon-user"></i></th>
                                            <th><i class="icon-graph"></i> Total</th>
                                            <th><i class="fa fa-smile-o fsize12"></i> Promoters</th>
                                            <th><i class="fa fa-smile-o fsize12"></i> Passive</th>
                                            <th><i class="fa fa-smile-o fsize12"></i> Detractors</th>
                                            <th><i class="icon-alarm-check"></i>Last Feedback</th>
                                            <th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i> Status</th>
                                            <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action</th>
                                            <th class="hidden" data-filter="status"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                        foreach ($oPrograms as $oProgram):

                                            $positive = 0;
                                            $nutral = 0;
                                            $negetive = 0;
                                            $totalFeedbackNum = 0;
                                            $hashcode = $oProgram->hashcode;
                                            $oContactsT = $mNPS->getMyUsers($hashcode);

                                            $lastContactList = end($oContactsT);
                                            if (!empty($lastContactList->created)) {
                                                $lastListTime = timeAgo($lastContactList->created);
                                            } else {
                                                $lastListTime = '';
                                            }

                                            $totalFeedback = $oProgram->NPS;

                                            foreach ($totalFeedback as $value) {
                                                $scoreVal = $value->score;
                                                if ($scoreVal > 8) {
                                                    $positive = $positive + 1;
                                                } else if ($scoreVal > 6 && $scoreVal < 9) {
                                                    $nutral = $nutral + 1;
                                                } else {
                                                    $negetive = $negetive + 1;
                                                }
                                            }

                                            $totalFeedbackNum = $positive + $nutral + $negetive;

                                            $aScoreSummery = $mNPS->getNPSScoreSummery($oProgram->hashcode);
                                            $score = number_format($aScoreSummery['NPSScore'], 1);

                                            @endphp
                                            <tr id="append-{{ $oProgram->id }}" class="selectedClass">
                                                <td style="display: none;">{{ date('m/d/Y', strtotime($oProgram->created)) }}</td>
                                                <td style="display: none;">{{ $oProgram->id }}</td>
                                                <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="{{ $oProgram->id }}" id="chk{{ $oProgram->id }}"><span class="custmo_checkmark"></span></label></td>
                                                <td>
                                                    <div class="media-left media-middle"> <a class="icons square" href="javascript:void(0);"><i class="icon-checkmark3 txt_blue"></i></a> </div>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a class="text-default text-semibold" href="{{ base_url() }}admin/modules/nps/setup/{{ $oProgram->id }}">{{ $oProgram->title }}</a></div>
                                                        <div class="text-muted text-size-small">{{ @(ucfirst($oProgram->platform)) ? ucfirst($oProgram->platform) : 'NA' }}</div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                    if ($score > 0) {
                                                        $scoreType = '';
                                                        @endphp
                                                        <div class="media-left media-middle">
                                                            <a target="_blank" href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}">
                                                                @php
                                                                if ($score > 80) {
                                                                    echo '<img src="' . base_url() . 'assets/images/smiley_green.png" class="img-circle img-xs" alt="">';
                                                                    $scoreType = 'Positive';
                                                                }

                                                                if ($score > 60 && $score <= 80) {
                                                                    echo '<img src="' . base_url() . 'assets/images/smiley_grey2.png" class="img-circle img-xs" alt="">';
                                                                    $scoreType = 'Netural';
                                                                }

                                                                if ($score <= 60) {
                                                                    echo '<img src="' . base_url() . 'assets/images/smiley_red.png" class="img-circle img-xs" alt="">';
                                                                    $scoreType = 'Negtive';
                                                                }
                                                                @endphp
                                                            </a>
                                                        </div>
                                                        <div class="media-left">
                                                            <div class=""><a target="_blank" href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}" class="text-default text-semibold">{{ $score }}</a>
                                                            </div>
                                                            <div class="text-muted text-size-small"><a href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}" class="text-default text-semibold">{{ $scoreType }}</a></div>
                                                        </div>
														@php
															} else {
                                                        @endphp
                                                        <div class="media-left media-middle">
														{!! showUserAvtar($totalFeedback[0]->avatar, $totalFeedback[0]->firstname, $totalFeedback[0]->lastname) !!}
                                                        </div>
                                                        <div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>
                                                        @php }
                                                    @endphp
                                                </td>
                                                <td> <div class="media-left">
                                                        <div class="pt-5"><a class="text-default text-semibold">{{ dataFormat($oProgram->created) }}</a></div>
                                                        <div class="text-muted text-size-small">{{ date('h:i A', strtotime($oProgram->created)) }}</div>
                                                    </div></td>
                                                <td>
                                                    @php
														if (!empty($oContactsT)) {
															$totPerson = count($oContactsT);
															$totWidth = 100;
														} else {
															$totPerson = '0';
															$totWidth = 0;
														}
														echo $totPerson;
                                                    @endphp

                                                </td>
                                                <td>
                                                    @php
														if ($totalFeedbackNum > 0) {
															$totFeedCount = $totalFeedbackNum;
															$totWidth = 100;
														} else {
															$totFeedCount = 0;
															$totWidth = 0;
														}

														$neturalRating = $totFeedCount;
														if ($totFeedCount > 0) {
															$neturalGraph = 100;
														} else {
															$neturalGraph = 0;
														}

														$addNUC = '';
														if ($neturalGraph > 50) {
															$addNUC = 'over50';
														}
                                                    @endphp
                                                    <a href="javascript:void(0);" title="total feedback">{{ $totFeedCount }}</a>
                                                </td>
                                                <td>
                                                    @php
														if ($totFeedCount > 0) {
															$divPosFeed = ($positive / $totFeedCount) * 100;
														} else {
															$divPosFeed = 0;
														}

														$neturalRating = $positive;
														if ($positive > 0) {
															$neturalGraph = ceil(($positive / $totFeedCount) * 100);
														} else {
															$neturalGraph = 0;
														}

														$addNUC = '';
														if ($neturalGraph > 50) {
															$addNUC = 'over50';
														}
                                                    @endphp
                                                    <div class="media-left">
                                                        <div class="progress-circle {{ $addNUC }} green cp{{ $neturalGraph }} @if ($neturalGraph > 0) createSegment @endif" segment-type="total-promoters" campaign-id="{{ $oProgram->id }}" campaign-type="email" title="click to create segment">
                                                            <div class="left-half-clipper">
                                                                <div class="first50-bar"></div>
                                                                <div class="value-bar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-left">
                                                        <div data-toggle="tooltip" title="Promoters Feedback {{ $neturalRating }}" data-placement="top">
                                                            @if ($neturalRating > 0)
																<a href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}?tab=promoters" class="text-default text-semibold">{{ $neturalRating }}</a>
															@else
																<a href="javascript:void(0);" class="text-default text-semibold">{{ $neturalRating }}</a>
															@endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @php
														//echo $nutral;
														if ($totFeedCount > 0) {
															$divNutFeed = ($nutral / $totFeedCount) * 100;
														} else {
															$divNutFeed = 0;
														}

														$neturalRating = $nutral;
														if ($nutral > 0) {
															$neturalGraph = ceil(($nutral / $totFeedCount) * 100);
														} else {
															$neturalGraph = 0;
														}

														$addNUC = '';
														if ($neturalGraph > 50) {
															$addNUC = 'over50';
														}
                                                    @endphp
                                                    <div class="media-left">
                                                        <div class="progress-circle {{ $addNUC }} gray cp{{ $neturalGraph }} @if ($neturalGraph > 0) createSegment @endif" segment-type="total-passive" campaign-id="{{ $oProgram->id }}" campaign-type="email" title="click to create segment">
                                                            <div class="left-half-clipper">
                                                                <div class="first50-bar"></div>
                                                                <div class="value-bar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-left">
                                                        <div data-toggle="tooltip" title="Passive Feedback {{ $neturalRating }}" data-placement="top">
                                                            @if ($neturalRating > 0)
																<a href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}?tab=passive" class="text-default text-semibold">{{ $neturalRating }}</a>
															@else
																<a href="javascript:void(0);" class="text-default text-semibold">{{ $neturalRating }}</a>
															@endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @php
														//echo $negetive;
														if ($totFeedCount > 0) {
															$divNegFeed = ($negetive / $totFeedCount) * 100;
														} else {
															$divNegFeed = 0;
														}

														$neturalRating = $negetive;
														if ($negetive > 0) {
															$neturalGraph = ceil(($negetive / $totFeedCount) * 100);
														} else {
															$neturalGraph = 0;
														}

														$addNUC = '';
														if ($neturalGraph > 50) {
															$addNUC = 'over50';
														}
                                                    @endphp
                                                    <div class="media-left">
                                                        <div class="progress-circle {{ $addNUC }} red cp{{ $neturalGraph }} @if ($neturalGraph > 0) createSegment @endif" segment-type="total-detractors" campaign-id="{{ $oProgram->id }}" campaign-type="email" title="click to create segment">
                                                            <div class="left-half-clipper">
                                                                <div class="first50-bar"></div>
                                                                <div class="value-bar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-left">
                                                        <div data-toggle="tooltip" title="Detractors Feedback {{ $neturalRating }}" data-placement="top">
                                                            @if ($neturalRating > 0)
																<a href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}?tab=detractors" class="text-default text-semibold">{{ $neturalRating }}</a>
															@else
																<a href="javascript:void(0);" class="text-default text-semibold">{{ $neturalRating }}</a>
															@endif
                                                        </div>
                                                    </div>

                                                </td>

                                                <td>
                                                    @php

														$totalFeedback = isset($totalFeedback[0]) ? $totalFeedback[0] : '';
														if (!empty($totalFeedback->score)) {
															if ($totalFeedback->score >= 8) {
																$ratingValue = $totalFeedback->score . '/10';
																$icon = ' <i class="fa fa-smile-o"></i></a>';
																$imageIcon = '<a href="#"><img src="http://brandboost.io/assets/images/userp.png" class="img-circle img-xs" alt=""></a>';
															} else if ($totalFeedback->score > 4) {
																$ratingValue = $totalFeedback->score . '/10';
																$icon = ' <i class="fa fa-smile-o"></i></a>';
																$imageIcon = '<a href="#"><img src="http://brandboost.io/assets/images/userp.png" class="img-circle img-xs" alt=""></a>';
															} else {
																$ratingValue = $totalFeedback->score . '/10';
																$icon = ' <i class="fa fa-smile-o"></i></a>';
																$imageIcon = '<a href="#"><img src="http://brandboost.io/assets/images/userp.png" class="img-circle img-xs" alt=""></a>';
															}
														} else {
															$ratingValue = '<div class="media-left"><span class="text-muted text-size-small">[No Data]</span></div>';
															$icon = '';
															$imageIcon = '';
														}
                                                    @endphp
                                                    <div class="media-left media-middle">{!! showUserAvtar($totalFeedback->avatar, $totalFeedback->firstname, $totalFeedback->lastname) !!}</div>
                                                    <div class="media-left">
                                                        <div class=""><a href="#" class="text-default text-semibold">
															{!! $ratingValue !!}
                                                        </div>
                                                        <div class="text-muted text-size-small">{{ @($totalFeedback->firstname) }} {{ @($totalFeedback->lastname) }}</div>
                                                        <div class="text-muted text-size-small">{{ $lastListTime }}</div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="tdropdown">
                                                        @php
															if ($oProgram->status == 'active') {
																echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
															} else if ($oProgram->status == 'draft') {
																echo '<i class="icon-primitive-dot txt_grey fsize16"></i> ';
															} else if ($oProgram->status == 'archive') {
																echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
															} else {
																echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
															}
                                                        @endphp
                                                        <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                                                            @php
																if ($oProgram->status == 'active') {
																	echo 'Active';
																} else if ($oProgram->status == 'draft') {
																	echo 'Pending';
																} else if ($oProgram->status == 'archive') {
																	echo 'Archive';
																} else {
																	echo 'Active';
																}
                                                            @endphp
                                                        </a>
                                                    </div>
                                                </td>

                                                <td class="text-center">

                                                    <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ base_url() }}assets/images/more.svg"></a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a target="_blank" href="{{ base_url('admin/modules/nps/stats/' . $oProgram->id) }}"><i class='icon-gear'></i>Stats</a></li>
                                                            @if ($oProgram->status == 'active')
                                                                <li><a nps_id="{{ $oProgram->id }}" change_status = 'draft' class='chg_status'><i class='icon-gear'></i>Inactive</a></li>
                                                            @else
                                                                <li><a nps_id="{{ $oProgram->id }}" change_status = 'active' class='chg_status'><i class='icon-gear'></i>Active</a></li>
                                                            @endif
                                                            <li><a href="javascript:void(0);" nps_id="{{ $oProgram->id }}" class="editSurvey"><i class="icon-file-stats"></i> Edit</a></li>
                                                            @if ($oProgram->status != 'archive')
                                                                <li><a href="javascript:void(0);" nps_id="{{ $oProgram->id }}" class="moveToArchiveNPS"><i class="icon-file-stats"></i> Move To Archive</a></li>
															@endif
                                                            <li><a href="javascript:void(0);" nps_id="{{ $oProgram->id }}" class="deleteNPS"><i class="icon-file-text2"></i> Delete</a></li>
                                                            <li><a target="_blank" href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}" class="text-default text-semibold"><i class='icon-gear'></i>View Score</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="hidden">
                                                    @php
														if ($oProgram->status == 'archive') {
															echo 'archive';
														} else {
															echo 'active';
														}
                                                    @endphp
                                                </td>
                                            </tr>
                                        @endforeach;
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
                                <h6 class="panel-title">{{ $iActiveCount }} NPS Surveys</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>&nbsp; &nbsp;

                                </div>
                            </div>

                            <div class="panel-body p0">
                                <table class="table datatable-basic datatable-sorting">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th><i class="icon-stack-star"></i> Name</th>
                                            <th class="text-center"><i class="icon-star-full2"></i> NPS Score</th>
                                            <th><i class="icon-calendar"></i> Created</th>
                                            <th><i class="icon-user"></i></th>
                                            <th><i class="icon-graph"></i> Total</th>
                                            <th><i class="fa fa-smile-o fsize12"></i></th>
                                            <th><i class="fa fa-smile-o fsize12"></i></th>
                                            <th><i class="fa fa-smile-o fsize12"></i></th>
                                            <th><i class="icon-alarm-check"></i>Last review</th>
                                            <th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i> Status</th>
                                            <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td colspan="14">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="margin: 20px 0px 0;" class="text-center">

                                                            <h5 class="mb-20 mt40">
                                                                Looks Like You Don’t Have Created Any NPS survey Yet <img src="{{ site_url('assets/images/smiley.png') }}"> <br>
                                                                Lets Create a New Survey.
                                                            </h5>

                                                            <button @if ($bActiveSubsription == false) title="No Active Subscription" class="btn dark_btn ml20 pDisplayNoActiveSubscription mb40" @else id="addNpsSurvery" @endif type="button" class="btn dark_btn ml20 mb40"><i class="icon-plus3"></i> Add New Survey</button>

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
</div>

<!-- /dashboard content -->

</div>
<!-- /content area -->

<div id="editSurveyModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmeditSurveyModel" name="frmeditSurveyModel">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Survey</h5>
                </div>

                <div id="npsTitleEdit">
                    <div class="modal-body">
                        <p>Survey Name:</p>
                        <input class="form-control" id="edit_title" name="title" placeholder="Enter Survey Name" type="text" required="required"><br>
                        <div id="editSurveyValidation" style="color:#FF0000;display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="nps_id" id="hidnpsid" value="" />
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add New Survey -->
<div id="addNPSModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmaddNPSModal" id="frmaddNPSModal" action="javascript:void();">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><img src="/new_pages/assets/css/menu_icons/OffSiteBoost_Color.svg"> Add New Survey &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>

                <div id="npsTitle">
                    <div class="modal-body">
                        <p>Survey Name:</p>
                        <input class="form-control" id="title" name="title" placeholder="Enter Survey Name" type="text" required="required"><br>
                        <div id="addNPSValidation" style="color:#FF0000;display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Create</button>
                        <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

@include('admin.modals.segments.segments-popup')
<script src="{{ base_url() }}assets/js/modules/segments/segments.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {

        // Setup - add a text input to each footer cell
        $('#npsModules thead tr').clone(true).appendTo('#npsModules thead');

        $('#npsModules thead tr:eq(1) th').each(function (i) {
            var filterType = $(this).attr('data-filter');
            if (filterType === 'status') {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="active" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatus">');

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

        var tableId = "npsModules";
        var tableBase = custom_data_table(tableId, '1' ,'desc');

        setTimeout(function () {
            $('#activeCampaign').trigger('click');
        }, 3000);


        $(document).on('click', '.filterByColumn', function () {

            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();
        });
    });
</script>


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

        $(document).on('click', '#deleteBulkNPS', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
				"This NPS will deleted immediately.<br>You can't undo this action.",
				function () {
					$('.overlaynew').show();
					$.ajax({
						url: "{{ base_url('admin/modules/nps/bulkDeleteNPS') }}",
						type: "POST",
						data: {_token: '{{csrf_token()}}', bulk_nps_id: val},
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


        $(document).on('click', '#archiveBulkNPS', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                archiveConfirmationPopup(
				"This NPS will move to archive immediately.<br>You can't undo this action.",
				function () {

					$('.overlaynew').show();
					$.ajax({
						url: "{{ base_url('admin/modules/nps/bulkArchiveNPS') }}",
						type: "POST",
						data: {_token: '{{csrf_token()}}', bulk_nps_id: val},
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


        $('#addNpsSurvery').click(function () {
            $('#addNPSModal').modal();
        });

        $('#frmaddNPSModal').on('submit', function () {

            $('.overlaynew').show();
            var formdata = $("#frmaddNPSModal").serialize();
            $.ajax({
                url: "{{ base_url('admin/modules/nps/addNPS') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = "{{ base_url('admin/modules/nps/setup/') }}" + data.id;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#addNPSValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#addNPSValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });


        $(document).on("click", ".editSurvey", function () {
            $('.overlaynew').show();
            var nps_id = $(this).attr('nps_id');
            $.ajax({
                url: "{{ base_url('admin/modules/nps/getNPS') }}",
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'nps_id': nps_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#edit_title").val(data.title);
                        $("#hidnpsid").val(nps_id);
                        $('.overlaynew').hide();
                        $("#editSurveyModel").modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });


        $(document).on("click", ".moveToArchiveNPS", function () {
            var nps_id = $(this).attr('nps_id');
            archiveConfirmationPopup(
			"This NPS will move to archive immediately.<br>You can't undo this action.",
			function () {

				$('.overlaynew').show();
				$.ajax({
					url: "{{ base_url('admin/modules/nps/moveToArchiveNPS') }}",
					type: "POST",
					data: {_token: '{{csrf_token()}}', 'nps_id': nps_id},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
							location.reload();
						} else {
							alertMessage('Error: Some thing wrong!');
						}
					}
				});
			});
        });


        $('#frmeditSurveyModel').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmeditSurveyModel").serialize();
            $.ajax({
                url: "{{ base_url('admin/modules/nps/updateNPS') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = "{{ base_url('admin/modules/nps/setup/') }}" + data.id;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#editSurveyValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#editSurveyValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });


        $(document).on('click', '.deleteNPS', function () {
            var nps_id = $(this).attr('nps_id');
            deleteConfirmationPopup(
			"This record will deleted immediately.<br>You can't undo this action.",
			function () {
				$('.overlaynew').show();
				$.ajax({
					url: "{{ base_url('admin/modules/nps/deleteNPS') }}",
					type: "POST",
					data: {_token: '{{csrf_token()}}', nps_id: nps_id},
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


        $(document).on('click', '.chg_status', function () {
            var npsID = $(this).attr('nps_id');
            var status = $(this).attr('change_status');
            $.ajax({
                url: "{{ base_url('admin/modules/nps/changeStatus') }}",
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'npsId': npsID, 'status': status},
                dataType: "html",
                success: function (data) {
                    window.location.href = "{{ base_url("/admin/modules/nps/") }}";
                }, error: function () {
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });


        $(document).on('click', '.editArchiveDataList', function () {
            $('.editArchiveAction').toggle();
        });

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });

    });

</script>
@endsection
