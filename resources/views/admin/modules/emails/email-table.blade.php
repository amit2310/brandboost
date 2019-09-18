<!-- Marketing campaigns -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title">{{ $title }}</h6>
        <div class="heading-elements">
            <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                <input class="form-control input-sm cus_search" tableid="emailsmsautomation" placeholder="Search by name" type="text">
                <div class="form-control-feedback">
                    <i class="icon-search4"></i>
                </div>
            </div>&nbsp; &nbsp;

            <div class="table_action_tool">
                <a href="javascript:void(0);"><i class="icon-calendar52"></i></a>
                @if ($pageType != 'overview')
                    <a href="javascript:void(0);" class="editDataList"><i class="icon-pencil"></i></a>
                @endif
                <a href="javascript:void(0);" style="display: none;" id="deleteButtonEmailAutomation" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                <a href="javascript:void(0);" style="display: none;" id="archiveButtonEmailAutomation" class="custom_action_box"><i class="icon-gear position-left"></i></a>
            </div>
        </div>
    </div>
    <div class="panel-body p0">
        @if (!empty($oAutomations))
            <table class="table" id="emailsmsautomation">
                <thead>
                <th style="display: none;"></th>
                <th style="display: none;"></th>
                <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                <th ><i class="icon-stack-star"></i>Automation Name</th>
                <th><i class="icon-calendar"></i>Created</th>
                <th><i class="icon-envelop2"></i>Total</th>
                <th><i class="icon-envelop2"></i>Open</th>
                <th><i class="icon-envelop2"></i>Click</th>
                <th><i class="icon-envelop2"></i>Bounce</th>
                <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                @if ($pageType != 'overview')
                    <th class="col-md-1 text-center"><i class="fa fa-dot-circle-o"></i>Action</th>
                @endif
                <th style="display:none;">status</th>
                </thead>
                <tbody>
                    @php
                    foreach ($oAutomations as $oAutomation):
                        $openValue = 0;
                        $clickValue = 0;
                        $bounceValue = 0;
                        $newOpen = $newClick = $newBounce = '';
                        if ($oAutomation->status != '') {
                            $oEvents = \App\Models\Admin\Modules\EmailsModel::getAutomationEvents($oAutomation->id);
                            foreach ($oEvents as $oEventsValue) {
                                //pre($oEventsValue->id);
                                $aStats = \App\Models\Admin\Modules\EmailsModel::getEmailSendgridStats('campaign', $oEventsValue->id);
                                //pre($aStats);
                                $aCategorizedStats = \App\Models\Admin\Modules\EmailsModel::getEmailSendgridCategorizedStatsData($aStats);
                                $open = $aCategorizedStats['open']['UniqueCount'];
                                $click = $aCategorizedStats['click']['UniqueCount'];
                                $bounce = $aCategorizedStats['bounce']['UniqueCount'];

                                if ($open > 0) {
                                    $openValue = $open + $openValue;
                                }
                                if ($click > 0) {
                                    $clickValue = $click + $clickValue;
                                }
                                if ($bounce > 0) {
                                    $bounceValue = $bounce + $bounceValue;
                                }
                            }

                            $totalValue = $openValue + $clickValue + $bounceValue;

                            $totalSentGraph = 0;
                            $totalOpenGraph = 0;
                            $totalClickGraph = 0;
                            $totalBounceGraph = 0;


                            $totalOpenGraph = ($totalValue == 0) ? 0 : ($openValue * 100 / $totalValue);
                            $totalOpenGraph = ceil($totalOpenGraph);

                            $totalClickGraph = ($totalValue == 0) ? 0 : ($clickValue * 100 / $totalValue);
                            $totalClickGraph = ceil($totalClickGraph);

                            $totalBounceGraph = ($totalValue == 0) ? 0 : ($bounceValue * 100 / $totalValue);
                            $totalBounceGraph = ceil($totalBounceGraph);
                            @endphp
                            <tr id="append-{{ $oAutomation->id }}" class="selectedClass">
                                <td style="display: none;">{{ date('m/d/Y', strtotime($oAutomation->created)) }}</td>
                                <td style="display: none;">{{ $oAutomation->id }}</td>
                                <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk{{ $oAutomation->id }}" value="{{ $oAutomation->id }}" ><span class="custmo_checkmark"></span></label></td>

                                <td>
                                    <div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-envelop txt_sblue"></i></a> </div>
                                    <div class="media-left">
                                        <div class=""><a href="{{ base_url() }}admin/modules/emails/setupAutomation/{{ $oAutomation->id }}" class="text-default text-semibold">{{ setStringLimit($oAutomation->title, 20) }}</a></div>
                                        <div class="text-muted text-size-small">
                                            {!! setStringLimit($oAutomation->description, 25) !!}
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="media-left">
                                        <div class="pt-5"><a href="#" class="text-default text-semibold">{{ dataFormat($oAutomation->created) }}</a></div>
                                        <div class="text-muted text-size-small">{{ date('h:i A', strtotime($oAutomation->created)) }}</div>
                                    </div>
                                </td>

                                <td>
                                    <div data-toggle="tooltip" title="" data-placement="top" data-original-title="Total emails {{ $totalValue }}">
                                        <a href="{{ base_url('admin/modules/emails/automationStats/' . $oAutomation->id) }}" class="text-default text-semibold pl20">{{ $totalValue }}</a>
                                    </div>
                                </td>

                                <td>
                                    @php
                                    $addPC = '';
                                    if ($totalOpenGraph > 50) {
                                        $addPC = 'over50';
                                    }
                                    @endphp
                                    <div class="media-left">
                                        <div class="progress-circle {{ $addPC }} green cp{{ $totalOpenGraph }}
                                            @if ($totalOpenGraph > 0)
                                            {{ 'createSegment' }}
                                            @endif
                                            " segment-type="total-open" campaign-id="{{ $oAutomation->id }}" campaign-type="email" title="click to create segment">
                                            <div class="left-half-clipper">
                                                <div class="first50-bar"></div>
                                                <div class="value-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-left">
                                        <div data-toggle="tooltip" title="{{ $openValue }} open out of {{ $totalValue }} emails" data-placement="top">
                                            @if ($openValue > 0)
                                                <a href="{{ base_url('admin/modules/emails/automationStats/' . $oAutomation->id) }}" class="text-default text-semibold">{{ $openValue }}</a>
                                            @else
                                                <a href="javascript:void(0);" class="text-default text-semibold">{{ $openValue }}</a>
                                            @endif
                                            @if ($newOpen > 0)
                                                {!! '<span style="color:#FF0000;"> (' . $newOpen . ' new)</span>' !!}
                                            @endif

                                        </div>
                                    </div>

                                </td>
                                <td>
                                    @php
                                    $addPC = '';
                                    if ($totalClickGraph > 50) {
                                        $addPC = 'over50';
                                    }
                                    @endphp
                                    <div class="media-left">
                                        <div class="progress-circle {{ $addPC }} grey cp{{ $totalClickGraph }}
                                            @if ($totalOpenGraph > 0)
                                            {{ 'createSegment'}}
                                            @endif
                                            " segment-type="total-click" campaign-id="{{ $oAutomation->id }}" campaign-type="email" title="click to create segment">
                                            <div class="left-half-clipper">
                                                <div class="first50-bar"></div>
                                                <div class="value-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-left">
                                        <div data-toggle="tooltip" title="{{ $clickValue }} open out of {{ $totalValue }} emails" data-placement="top">
                                            @if ($clickValue > 0)

                                                <a href="{{ base_url('admin/modules/emails/automationStats/' . $oAutomation->id) }}" class="text-default text-semibold">{{ $clickValue }}</a>
                                            @else
                                                <a href="javascript:void(0);" class="text-default text-semibold">{{ $clickValue }}</a>
                                            @endif
                                            @if ($newClick > 0)
                                                {!! '<span style="color:#FF0000;"> (' . $newClick . ' new)</span>' !!}
                                            @endif

                                        </div>
                                    </div>

                                </td>
                                <td>
                                    @php
                                    $addPC = '';
                                    if ($totalBounceGraph > 50) {
                                        $addPC = 'over50';
                                    }
                                    @endphp
                                    <div class="media-left">
                                        <div class="progress-circle {{ $addPC }} red cp{{ $totalBounceGraph }}
                                            @if ($totalBounceGraph > 0)
                                            {{'createSegment'}}
                                            @endif
                                            " segment-type="total-bounce" campaign-id="{{ $oAutomation->id }}" campaign-type="email" title="click to create segment">
                                            <div class="left-half-clipper">
                                                <div class="first50-bar"></div>
                                                <div class="value-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-left">
                                        <div data-toggle="tooltip" title="{{ $bounceValue }} open out of {{ $totalValue }} emails" data-placement="top">
                                            @if ($bounceValue > 0)
                                                <a href="{{ base_url('admin/modules/emails/automationStats/' . $oAutomation->id) }}" class="text-default text-semibold">{{ $bounceValue }}</a>
                                            @else
                                                <a href="javascript:void(0);" class="text-default text-semibold">{{ $bounceValue }}</a>
                                            @endif
                                            @if ($newBounce > 0)
                                                {!! '<span style="color:#FF0000;"> (' . $newBounce . ' new)</span>' !!}
                                            @endif

                                        </div>
                                    </div>

                                </td>

                                <td class="text-center">


                                    @if ($oAutomation->status == 'active')
                                        <i class="icon-primitive-dot txt_green fsize16"></i>
                                    @else
                                        <i class="icon-primitive-dot txt_red fsize16"></i>
                                    @endif
                                    <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">{{ ucfirst($oAutomation->status) }}</a>
                                    <ul class="dropdown-menu dropdown-menu-right status">

                                    </ul>
                                </td>
                                @if ($pageType != 'overview')
                                    <td class="text-center">

                                        <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><img src="{{ base_url() }}assets/images/more.svg"></a>
                                            <ul class="dropdown-menu dropdown-menu-right more_act">
                                                <li><a href="javascript:void(0);" automation_id="{{ $oAutomation->id }}" class="editAutomation"><i class="icon-pencil"></i> Edit</a></li>
                                                @if ($oAutomation->status == 'active')
                                                    <li>
                                                        <a href="javascript:void(0);" automation_id="{{ $oAutomation->id }}" status="inactive" class="change_staus"><i class='icon-file-locked'></i> Inactive</a>
                                                    </li>
                                                @endif
                                                @if ($oAutomation->status == 'inactive' || $oAutomation->status == 'draft')
                                                    <li>
                                                        <a href="javascript:void(0);" automation_id="{{ $oAutomation->id }}" status="active" class="change_staus"><i class='icon-file-locked'></i> Active</a>
                                                    </li>
                                                @endif
                                                @if ($oAutomation->status != 'archive')
                                                    <li>
                                                        <a href="javascript:void(0);" automation_id="{{ $oAutomation->id }}" status="archive" class="change_staus"><i class='icon-file-locked'></i> Move To Archive</a>
                                                    </li>
                                                @endif
                                                <li><a href="javascript:void(0);" automation_id="{{ $oAutomation->id }}" class="deleteAutomation"><i class="icon-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>

                                    </td>
                                @endif
                                <td style="display:none;">
                                    @if ($oAutomation->status == 'archive')
                                        {{ 'archive' }}
                                    @else
                                        {{ 'active' }}
                                    @endif
                                </td>


                            </tr>
                        @php } endforeach @endphp
                </tbody>
            </table>
        @else
            <table class="table datatable-basic">
                <thead>

                <th ><i class="icon-stack-star"></i>Automation Name</th>
                <th ><i class="icon-calendar"></i>Created</th>
                <th><i class="icon-envelop2"></i>Email</th>
                <th><i class="icon-envelop2"></i>Open</th>
                <th><i class="icon-envelop2"></i>Click</th>
                <th><i class="icon-envelop2"></i>Bounce</th>
                <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                <th class="col-md-1 text-center"><i class="fa fa-dot-circle-o"></i>Action</th>

                </thead>

                <tbody>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td colspan="10">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="margin: 20px 0px 0;" class="text-center">
                                <h5 class="mb-20 mt40">
                                    Looks Like You Don’t Have Created Any {{ ucfirst($automation_type) }} Automation Yet <img src="{{ site_url('assets/images/smiley.png') }}"> <br>
                                    Lets Create {{ ucfirst($automation_type) }} Automation.
                                </h5>

                            </div>
                        </div>
                    </div>
                </td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td style="display: none"></td>

                </tbody>
            </table>
        @endif
    </div>
</div>



