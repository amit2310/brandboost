@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src = "https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="http://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
<script type="text/javascript" src="http://www.chartjs.org/samples/latest/utils.js"></script>


<!-- /theme JS files -->
<style>
    #canvas, #canvas2{height: 330px!important;}
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
</style>
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img style="width: 19px;" src="{{ base_url() }}assets/images/nps_icon.png"> NPS Overview</h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter reports &nbsp; &nbsp; <span class="caret"></span>
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
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->


    <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="right-icon-tab0">
            <div class="row">
                <div class="col-md-8 ">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">NPS</h6>
                        </div>
                        @php
							$npmArr = array();
							foreach ($oProgramsDate as $value) {

								$created = $value->created;
								$createdTotal = $value->createdTotal;
								$npmMonth = (object) array('y' => date('d M', strtotime($created)), 'a' => $createdTotal);
								$npmArr[] = $npmMonth;
							}
							$npmJsonEncode = json_encode($npmArr);
							$pos = $neu = $neg = $totleScore = 0;
							foreach ($oPrograms as $value) {
								if (!empty($value->NPS)) {
									foreach ($value->NPS as $npsval) {

										if ($npsval->score >= 6) {
											$pos++;
										} else if ($npsval->score >= 4) {
											$neu++;
										} else {
											$neg++;
										}
										$totleScore++;
									}
								}
							}

							$posPersent = number_format($pos / $totleScore * 100, '1');
							$neuPersent = number_format($neu / $totleScore * 100, '1');
							$negPersent = number_format($neg / $totleScore * 100, '1');
                        @endphp
                        <div class="panel-body p0 bkg_white">
                            <div class="p20 bbot">
                                <p class="txt_grey fw300 m0"><i class="fa fa-square txt_green3"></i>  &nbsp; NPS over time &nbsp; &nbsp; <strong class="txt_dark">51,913</strong></p>
                            </div>
                            <div class="p20" style="background: #fcfdfe!important; border-radius: 0 0 6px 6px">
                                <div id="myfirstchart" style="height: 170px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Customer Retention</h6>
                                </div>
                                <div class="panel-body bkg_white" style="min-height: 268px;">
                                    <div class="p30 text-center">
                                        <img width="200" src="{{ base_url() }}assets/images/nps_graph.png"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Customer Effort Score</h6>
                                </div>
                                <div class="panel-body bkg_white p0" style="min-height: 268px;">
                                    <div class="p20 bbot">
                                        <p class="txt_grey fw300 m0"><i class="fa fa-square txt_green3"></i>  &nbsp; Score &nbsp; &nbsp; <strong class="txt_dark">1.7</strong></p>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12"><div id="linechart_a" style="min-width: 300px; height: 205px;"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Daily NPS</h6>
                        </div>
                        <div class="panel-body p20 bkg_white pb-5" style="padding-bottom: 5px!important;">
                            <div class="p20">
                                <div id="donut_chartbb" style="max-width: 100%; height: 200px; margin: 0 auto; "></div>
                            </div>
                            <div class="clearfix"></div>
                            <ul class="onsite_list">
                                <li><span class="txt_dark"><img width="12" src="{{ base_url() }}assets/images/smiley_icon_green.png"> Positive</span><strong>{{ $posPersent }}%</strong></li>
                                <li><span><img width="12" src="{{ base_url() }}assets/images/smiley_icon_yellow.png"> Neutral</span><strong>{{ $neuPersent }}%</strong></li>
                                <li><span><img width="12" src="{{ base_url() }}assets/images/smiley_icon_red.png"> Negative</span><strong>{{ $negPersent }}%</strong></li>
                            </ul>
                        </div>
                    </div>


                    <div class="panel panel-flat">
                        <div class="panel-heading pl30">
                            <h6 class="panel-title">Promoters</h6>
                        </div>
                        <div class="panel-body p30 db_stats bkg_white">
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="media-left">
                                        <h1>1,468</h1><p><strong class="txt_green"><i class=""><img src="{{ base_url() }}assets/images/green_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p>
                                    </div>
                                </div>
                                <div class="col-xs-4 text-right"><img src="{{ base_url() }}assets/images/nps_graph_small.png"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!--============Table ===========-->

            <div class="row">
                <div class="col-md-12">
                    <div style="margin: 0;" class="panel panel-flat">
                        <div class="panel-heading">
                            <span class="pull-left">
                                <h6 class="panel-title">NPS Survey</h6>
                            </span>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" tableid="npsModules" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>&nbsp; &nbsp;

                                <div class="table_action_tool">
                                    <a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="{{ base_url() }}assets/images/icon_refresh.png"></i></a>
                                    <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_calender.png"></i></a>
                                    <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_download.png"></i></a>
                                    <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_upload.png"></i></a>
                                    <a href="javascript:void(0);" class="editDataList"><i class=""><img src="{{ base_url() }}assets/images/icon_edit.png"></i></a>
                                    <a href="javascript:void(0);" style="display: none;" id="deleteBulkNPS" class="custom_action_box"><i class="icon-trash position-left"></i></a>
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
                                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_date.png"/></i> Campaign Name</th>
                                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_people.png"/></i> Email</th>
                                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_click.png"/></i> </th>
                                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_display.png"/></i> </th>
                                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_refresh2.png"/></i> </th>
                                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_date.png"/></i> Created</th>
                                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_staats.png"/></i> Stats</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                    $totFeedCount = 0;
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
                                            if ($scoreVal >= 8) {
                                                $positive = $positive + 1;
                                            } else if ($scoreVal > 4) {
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

                                            <td><div class="media-left media-middle"> <img width="24" src="{{ base_url() }}assets/images/sms_icon_24.png"/> </div>
                                                <div class="media-left">
                                                    <div class=""><a href="{{ base_url() }}admin/modules/nps/setup/{{ $oProgram->id }}" class="text-default text-semibold bbot">{{ $oProgram->title }}</a></div>
                                                </div>
                                            </td>
                                            <td><div style="width: 117px;" class="media-left text-right pr40 brig"><a href="#" class="text-default text-semibold">1293</a></div></td>
                                            <td>
                                                @php
													if ($totFeedCount > 0) {
														$divPosFeed = ($positive / $totFeedCount) * 100;
													} else {
														$divPosFeed = 0;
													}

													$neturalRating = $positive;
													if ($positive > 0 && $totFeedCount>0) {
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
                                                    <div class="progress-circle {{ $addNUC }} green cp{{ $neturalGraph }}">
                                                        <div class="left-half-clipper">
                                                            <div class="first50-bar"></div>
                                                            <div class="value-bar"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-left">
                                                    <div data-toggle="tooltip" title="Promoters Feedback {{ $neturalRating }}" data-placement="top">
                                                        @if ($neturalRating > 0)
															<a href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}?tab=promoters" class="text-default text-semibold">
                                                                {{ $neturalRating }}
															</a>
														@else
															<a href="javascript:void(0);" class="text-default text-semibold">{{ $neturalRating }}</a>
														@endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
													if ($totFeedCount > 0) {
														$divNutFeed = ($nutral / $totFeedCount) * 100;
													} else {
														$divNutFeed = 0;
													}

													$neturalRating = $nutral;
													if ($nutral > 0 && $totFeedCount>0) {
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
                                                    <div class="progress-circle {{ $addNUC }} gray cp{{ $neturalGraph }}">
                                                        <div class="left-half-clipper">
                                                            <div class="first50-bar"></div>
                                                            <div class="value-bar"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-left">
                                                    <div data-toggle="tooltip" title="Passive Feedback {{ $neturalRating }}" data-placement="top">
                                                        @if ($neturalRating > 0)
															<a href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}?tab=passive" class="text-default text-semibold">
                                                                {{ $neturalRating }}
															</a>
														@else
															<a href="javascript:void(0);" class="text-default text-semibold">{{ $neturalRating }}</a>
														@endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
													if ($totFeedCount > 0) {
														$divNegFeed = ($negetive / $totFeedCount) * 100;
													} else {
														$divNegFeed = 0;
													}

													$neturalRating = $negetive;
													if ($negetive > 0 && $totFeedCount>0) {
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
                                                    <div class="progress-circle {{ $addNUC }} red cp{{ $neturalGraph }}">
                                                        <div class="left-half-clipper">
                                                            <div class="first50-bar"></div>
                                                            <div class="value-bar"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-left">
                                                    <div data-toggle="tooltip" title="Detractors Feedback {{ $neturalRating }}" data-placement="top">
                                                        @if ($neturalRating > 0)
															<a href="{{ base_url('admin/modules/nps/score/' . $oProgram->hashcode) }}?tab=detractors" class="text-default text-semibold">
                                                                {{ $neturalRating }}
															</a>
														@else
															<a href="javascript:void(0);" class="text-default text-semibold">{{ $neturalRating }}</a>
														@endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div class="media-left">
                                                    <div><a href="#" class="text-default text-semibold dark">{{ dataFormat($oProgram->created) }}</a></div>
                                                </div>
                                                <div class="media-left pr40 brig">
                                                    <div class="text-muted">{{ date('h:i A', strtotime($oProgram->created)) }}</div>
                                                </div>
                                            </td>
                                            <td><a target="_blank" href="{{ base_url('admin/modules/nps/stats/' . $oProgram->id) }}"><img src="{{ base_url() }}assets/images/nps_graph_small2.png" class="" alt="Graph"></a>
                                            </td>
                                            <td><label class="custom-form-switch">

                                                    <input class="field" type="checkbox" @php
                                                    if ($oProgram->status == 'active') {
                                                        echo 'checked';
                                                    }
                                                    @endphp >
                                                    <span class="toggle greenl"></span> </label>
                                                <div class="media-left pull-right text-right">
                                                    <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="{{  base_url() }}assets/images/more.svg"></a>

                                                        <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
															@if ($oProgram->status == 'active')
                                                                <li><a nps_id="{{ $oProgram->id }}" change_status = 'draft' class='chg_status'><i class="icon-primitive-dot txt_red"></i> Inactive</a></li>
                                                            @else
                                                                <li><a nps_id="{{ $oProgram->id }}" change_status = 'active' class='chg_status'><i class="icon-primitive-dot txt_green"></i> Active</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>                                           
                                        </tr>
                                    @php endforeach @endphp
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--===========TAB 2===========-->
    <div class="tab-pane" id="right-icon-tab1"> </div>
    <!--===========TAB 3====Preferences=======-->
    <div class="tab-pane" id="right-icon-tab2"> </div>
    <!--===========TAB 4====Chat Widget=======-->
    <div class="tab-pane" id="right-icon-tab3"> </div>
    <!--===========TAB 5===========-->
    <div class="tab-pane" id="right-icon-tab4"> </div>
</div>
<!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->
</div>

<script type="text/javascript">


    $(document).ready(function () {

        $(document).on('click', '.chg_status', function () {
            var npsID = $(this).attr('nps_id');
            var status = $(this).attr('change_status');
            $.ajax({
                url: "{{ base_url('admin/modules/nps/changeStatus') }}",
                type: "POST",
                data: {'npsId': npsID, 'status': status},
                dataType: "html",
                success: function (data) {
                    window.location.href = "{{ base_url('/admin/modules/nps/overview') }}";
                }, error: function () {
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });


        var tableId = "npsModules";
        var tableBase = custom_data_table(tableId, '1', 'desc');

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
						data: {bulk_nps_id: val},
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
						data: {bulk_nps_id: val},
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
                data: {'nps_id': nps_id},
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
					data: {'nps_id': nps_id},
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
					data: {nps_id: nps_id},
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
                data: {'npsId': npsID, 'status': status},
                dataType: "html",
                success: function (data) {
                    window.location.href = "{{ base_url('/admin/modules/nps/') }}";
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

<script>


    Highcharts.chart('linechart_a', {
        chart: {
            type: 'column',
            backgroundColor: 'rgba(0, 0, 0, 0)',
        },
        title: {
            text: null
        },
        subtitle: {
            text: null
        },
        xAxis: {
            type: 'category',
            labels: {

                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif',

                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: null
            }
        },
        legend: {
            enabled: false
        },

        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 5
            }
        },

        colors: ['#9ecc78', '#cae4d1'],
        tooltip: {
            pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
        },
        series: [{
                showInLegend: false,
                name: 'Time',
                data: [
                    ['1', 14.2],
                    ['2', 3.8],
                    ['3', 2.9],
                    ['4', 16.7],
                    ['5', 9.1],
                    ['6', 18.7],
                    ['7', 15.4],
                    ['8', 14.2],
                    ['12', 3.8],
                    ['13', 2.9],
                    ['14', 16.7],
                    ['15', 9.1],
                    ['16', 18.7]
                ],

            }]
    });





    var config = {
        type: 'line',
        data: {
            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15"],
            datasets: [{
                    label: 'On Site Reviews Report',
                    backgroundColor: window.chartColors.green,
                    borderColor: window.chartColors.green,
                    data: [12, 50, 3, 5, 22, 3, 12, 19, 3, 5, 45, 3, 12, 35, 3],
                    fill: false,
                }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                //stext: 'Chart.js Line Chart'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Month'
                        }
                    }],
                yAxes: [{
                        display: false,
                        scaleLabel: {
                            display: false,
                            labelString: 'Value'
                        }
                    }]
            }
        }
    };

    window.onload = function () {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };



    Highcharts.chart('donut_chartbb', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: null
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },

        colors: ['#74d4a6', '#ffd074', '#df6783'],
        series: [{
                name: 'Rating',
                colorByPoint: true,
                data: [{
                        name: 'Positive',
                        y: <?php echo $pos; ?>,
                    }, {
                        name: 'Neutral',
                        y: <?php echo $neu; ?>
                    }, {
                        name: 'Negative',
                        y: <?php echo $neg; ?>
                    }]
            }]
    });



    Morris.Area({
        element: 'myfirstchart',
        parseTime: false,

        data: <?php echo $npmJsonEncode; ?>,

        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total'],
        pointSize: 0,
        lineWidth: 2,
        padding: 0,
        fillOpacity: 0.3,
        hideHover: 'auto',
        behaveLikeLine: true,
        resize: true,
        pointFillColors: ['#ffffff'],
        pointStrokeColors: ['black'],
        lineColors: ['#9ecc78 ', '#0c265a'],

    });

</script>
@endsection