@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
<script type="text/javascript" src="{{ base_url() }}assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/pages/datatables_sorting_date.js"></script>
<!-- Content area -->
<div class="content">
    <!-- top small boxes section-->
    <div class="row">
        @foreach ($stats as $key => $aUnitStat)
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-body panel-body-accent">
                    <div class="media no-margin">
                        <div class="media-body text-center">
                            <span class="text-uppercase text-size-mini text-muted">{{ ucwords(str_replace("-", " ", $key)) }}</span>
                            <h3 class="no-margin text-semibold"> {{ ($aUnitStat['Trial']) ? $aUnitStat['Trial'] : 0 }} </h3>
                            <span class="text-uppercase text-size-mini text-muted">Trial Subscription</span>
                        </div>
                    </div>
                </div>

                <div class="panel panel-body panel-body-accent">
                    <div class="media no-margin">
                        <div class="media-body text-center">
                            <span class="text-uppercase text-size-mini text-muted">{{ ucwords(str_replace("-", " ", $key)) }}</span>
                            <h3 class="no-margin text-semibold"> {{ ($aUnitStat['Active']) ? $aUnitStat['Active'] : 0 }} </h3>
                            <span class="text-uppercase text-size-mini text-muted">Active Subscription</span>
                        </div>
                    </div>
                </div>

                <div class="panel panel-body panel-body-accent">
                    <div class="media no-margin">
                        <div class="media-body text-center">
                            <span class="text-uppercase text-size-mini text-muted">{{ ucwords(str_replace("-", " ", $key)) }}</span>
                            <h3 class="no-margin text-semibold"> {{ ($aUnitStat['Paused']) ? $aUnitStat['Paused'] : 0 }} </h3>
                            <span class="text-uppercase text-size-mini text-muted">Paused Subscription</span>
                        </div>
                    </div>
                </div>

                <div class="panel panel-body panel-body-accent">
                    <div class="media no-margin">
                        <div class="media-body text-center">
                            <span class="text-uppercase text-size-mini text-muted">{{ ucwords(str_replace("-", " ", $key)) }}</span>
                            <h3 class="no-margin text-semibold"> {{ ($aUnitStat['Cancelled']) ? $aUnitStat['Cancelled'] : 0 }} </h3>
                            <span class="text-uppercase text-size-mini text-muted">Cancelled Subscription</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- top small boxes section-->

    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ $title }} Management</h6>
                    <div class="heading-elements">
                        <span class="label bg-success heading-text">{{ count($usersdata) }} {{ $title }}</span>
                        <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                            <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <input name="min" id="min" type="hidden">
                    <input name="max" id="max" type="hidden">
                    <table class="table tasks-list table-lg datatable-sorting text-nowrap">
                        <thead>
                            <tr>
                                <th>PLAN NAME</th>
                                <th>CLIENT</th>
                                <th>PRICE</th>
                                <th>TRIAL DURATION</th>
                                <th>DATE CREATED</th>
                                <th>STATUS</th>
                                <th class="text-center nosort">ACTION</th>
                                <th style="display: none;"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($usersdata))
                                @foreach ($usersdata as $aRow)
                                    <tr>
                                        <td>{{ ($aRow->plan_title) ? $aRow->plan_title : '-' }}</td>
                                        <td>
                                            <div class="text-semibold"><a class="text-default text-semibold" href="#">{{ $aRow->firstname . ' ' . $aRow->lastname }}</a></div>
                                        </td>
                                        <td>
                                            @if ($aRow->type == 'topup')
                                                ${{ $aRow->topup_fee . '/' . ucwords($aRow->billing_period_unit) }}
                                            @elseif ($aRow->type == 'membership')
                                                ${{ $aRow->price . '/' . ucwords($aRow->billing_period_unit) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($aRow->trial_start) || !empty($aRow->trial_end))
                                                {{ date("F d, Y", $aRow->trial_start) . ' To ' . date("F d, Y", $aRow->trial_end) }}
                                            @else {
                                                {{ '-' }}
                                            @endif
                                        </td>
                                        <td><div class="text-semibold">
												{{ date('F d, Y', strtotime($aRow->created)) }} 
											</div>
											<div class="text-muted text-size-small">
												{{ date('h:i A', strtotime($aRow->created)) }} ({{ timeAgo($aRow->created) }})
											</div>
                                        </td>
                                        <td>
                                            <span class="label 
												@if ($aRow->subscription_status == 'active')
                                                    bg-success
                                                @elseif ($aRow->subscription_status == 'in_trial')
                                                    bg-blue
                                                @elseif ($aRow->subscription_status == 'paused')
                                                    bg-danger
                                                @elseif ($aRow->subscription_status == 'cancelled')
                                                    bg-danger
                                                @elseif ($aRow->subscription_status == 'deleted')   
                                                    bg-danger
                                                @endif">{{ str_replace("_", " ", $aRow->subscription_status) }}
											</span>
                                        </td>

                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="javascript:void(0);" @if ($aRow->subscription_status != 'cancelled' && $aRow->subscription_status != 'deleted') class="change_subs" @else style="color:#ccc;" @endif subs_id="{{ $aRow->subscription_id }}" action_name="cancel" ><i class="icon-coin-dollar"></i> Cancel Subscription</a></li>
                                                        <li><a href="javascript:void(0);" @if ($aRow->subscription_status != 'active' && $aRow->subscription_status != 'deleted' && $aRow->subscription_status != 'in_trial')  class="change_subs" @else style="color:#ccc;" @endif subs_id="{{ $aRow->subscription_id }}" action_name="reactivate" ><i class="icon-coin-dollar"></i> Reactivate Subscription</a></li>
                                                        <li><a href="javascript:void(0);" @if ($aRow->subscription_status != 'paused' && $aRow->subscription_status != 'deleted') style="color:#ccc;" @else style="color:#ccc;" @endif subs_id="{{ $aRow->subscription_id }}" action_name="pause"><i class="icon-coin-dollar"></i> Pause Subscription</a></li>
                                                        <li><a href="javascript:void(0);" @if ($aRow->subscription_status != 'resume' && $aRow->subscription_status != 'deleted') style="color:#ccc;" @else style="color:#ccc;" @endif subs_id="{{ $aRow->subscription_id }}" action_name="resume"><i class="icon-coin-dollar"></i> Resume Subscription</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="javascript:void(0);" @if ($aRow->subscription_status != 'deleted') class="change_subs" @else style="color:#ccc;" @endif subs_id="{{ $aRow->subscription_id }}" action_name="delete"><i class="icon-cross2"></i> Delete Subscription</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                        <td style="display: none;">{{ date('m/d/Y', strtotime($aRow->created)) }}</td>
                                    </tr>
                                @endforeach
                            @endif                              
                        </tbody>
                    </table>
                </div>
            </div>
            <div align="right" id="pagination_link"></div>
        </div>
    </div>
</div>
<!-- /content area -->
<script>
    $(document).ready(function () {
        $(document).on("click", ".change_subs", function () {
            $('.overlaynew').show();
            var actionName = $(this).attr("action_name");
            var subID = $(this).attr("subs_id");
            if (confirm("Are you sure you want to " + actionName + " subscription?")) {
                $.ajax({
                    url: "{{ base_url('payment/changeSubscription') }}",
                    type: "POST",
                    data: {action: actionName, subid: subID,_token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            alertMessageAndRedirect(data.msg, window.location.href);
                        } else {
                            alertMessage(data.msg);
                            $('.overlaynew').hide();
                        }
                    }
                });
            }
        });
    });
</script>
@endsection