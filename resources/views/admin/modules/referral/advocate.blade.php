@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img style="width: 16px;" src="{{ base_url() }}assets/images/refferal_icon.png">Advocates</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active all"><a style="javascript:void();" id="activeAdvocates" class="filterByColumn" fil="active">Active Campaigns</a></li>
                    <li><a style="javascript:void();" class="filterByColumn" fil="archive">Archive</a></li>
                </ul>

            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Programs &nbsp; &nbsp; <span class="caret"></span>
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
        <!--===========TAB 1=======Active Advocates====-->
        <div class="tab-pane active" id="right-icon-tab0">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-flat">
                        <?php //$this->load->view("admin/components/smart-popup/smart-advocate-widget");?>
                        <div class="panel-heading">
                            <h6 class="panel-title">Advocates</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" tableID="advocatesTable" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>
                                <div class="table_action_tool">
                                    <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_calender.png"/></i></a>
                                    <a href="javascript:void(0);" class="editDataList"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_edit.png"/></i></a>
                                    <a href="javascript:void(0);" id="deleteBulkModuleContacts" class="custom_action_box" style="display:none;" data-modulename="referral" data-moduleaccountid="{{ $moduleUnitID }}"><i class="icon-trash position-left"></i></a>
                                    <button id="archiveBulkModuleContacts" class="btn btn-xs custom_action_box" data-modulename="referral" data-moduleaccountid="{{ $moduleUnitID }}"><i class="icon-gear position-left"></i> Archive</button>
                                </div>

                            </div>
                        </div>
                        <div class="panel-body p0">
                            @if(!empty($oContacts))
                            <table class="table" id="advocatesTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th style="display: none;" class="nosort editAction" style="width:30px;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                        <th><i class="icon-user"></i>Advocate</th>
                                        <th><i class="icon-calendar"></i>Programs</th>
                                        <th><i class="icon-user"></i>Email</th>
                                        <th><i class="icon-envelop"></i>Created</th>
                                        <th><i class="icon-warning2"></i>Visits</th>
                                        <th><i class="icon-warning2"></i>Sales</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th style="display:none;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    foreach ($oContacts as $oContact) {
                                        $moduleName = 'referral';
                                        $moduleUnitID = $oContact->account_id;
                                        $referralData = \App\Models\Admin\Modules\ReferralModel::getReferralByAccountId($moduleUnitID);
                                        $referralTrackData = \App\Models\Admin\Modules\ReferralModel::getReferralLinkVisitsByAdvocateId($oContact->subscriber_id, $referralData->id);
                                        $referralSaleTrackData = \App\Models\Admin\Modules\ReferralModel::referredSalesByAdvocateId($oContact->subscriber_id, $moduleUnitID);
                                        @endphp
                                        <tr>
                                            <td style="display: none;">{{ date('m/d/Y', strtotime($oContact->created)) }}</td>
                                            <td style="display: none;">{{ $oContact->id }}</td>
                                            <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="{{ $oContact->id }}" ><span class="custmo_checkmark"></span></label></td>
                                            <td class="viewAdvocateSmartPopup" data-modulesubscriberid="{{ $oContact->subscriber_id }}" data-accountid="{{ $moduleUnitID }}">											
                                                <div class="media-left media-middle"> {!! showUserAvtar($oContact->avatar, $oContact->firstname, $oContact->lastname) !!} </div>
                                                <div class="media-left">
                                                    <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold">{{ $oContact->firstname. ' '. $oContact->lastname }}</a> <img class="flags" src="{{ base_url() }}assets/images/flags/{{ strtolower($oContact->country_code) }}.png" onerror="this.src='{{ base_url('assets/images/flags/us.png')}}'"/></div>
                                                </div>
                                            </td>
                                            <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-tree5 txt_sblue"></i></a> </div>
                                                <div class="media-left">
                                                    <div class="pt-5"><a href="{{ base_url() }}admin/modules/referral/setup/{{ $referralData->id }}" class="text-default text-semibold">{{ $referralData->title }}</a></div>
                                                </div></td>
                                            <td><div class="media-left">
                                                    <div class="pt-5"><a href="#" class="text-default text-semibold">{{ $oContact->email }}</a></div>
                                                    <div class="text-muted text-size-small">{!! $oContact->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : mobileNoFormat($oContact->phone) !!}</div>
                                                </div></td>
                                            <td>
                                                <div class="media-left">
                                                    <div class="pt-5"><span class="text-default text-semibold dark">{{ date('F dS Y', strtotime($oContact->created)) }}</span></div>
                                                    <div class="text-muted text-size-small">{{ date('h:i A', strtotime($oContact->created)) }}</div>
                                                </div>
                                            </td>
                                            <td><a style="cursor: auto;" class="text-default text-semibold"><img class="progress_icon" src="{{ base_url() }}assets/images/progress_green.png"/> &nbsp; {{ count($referralTrackData) }}</a></td>
                                            <td><a style="cursor: auto;" class="text-default text-semibold"><img class="progress_icon" src="{{ base_url() }}assets/images/progress_red.png"/> &nbsp; {{ count($referralSaleTrackData) }}</a></td>

                                            <td><div class="tdropdown">
                                                    @php echo ($oContact->status == 1 && $oContact->globalStatus == 1) ? '<i class="icon-primitive-dot txt_green fsize16"></i>' : '<i class="icon-primitive-dot txt_red fsize16"></i>' @endphp <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">{{ ($oContact->status == 1 && $oContact->globalStatus == 1) ? ' Active' : 'Archive' }}</a>
                                                    <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                        @if ($oContact->status == 1 && $oContact->globalStatus == 1)
                                                            <li><a class='changeModuleContactStatus' data-modulesubscriberid="{{ $oContact->id }}" data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}" data_status = '0'><i class="icon-primitive-dot txt_grey"></i> Inactive</a></li>
                                                        @else
                                                            <li><a class='@if ($oContact->globalStatus == 1) changeModuleContactStatus @else changeModuleContactStatusDisabled @endif'  data-modulesubscriberid="{{ $oContact->id }}" data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}" data_status = '1'><i class="icon-primitive-dot txt_green"></i> Active</a></li>
                                                        @endif
                                                        <li><a class="moveToArchiveModuleContact" href="javascript:void(0);" data-modulesubscriberid="{{ $oContact->id }}" data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
                                                    </ul>
                                                </div></td>
                                            <td class="text-center">
                                                <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="{{ base_url() }}assets/images/more.svg"></a>
                                                    <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                        <li><a class="moveToArchiveModuleContact" href="javascript:void(0);" data-modulesubscriberid="{{ $oContact->id }}" data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}"><i class="icon-trash"></i> Move To Archive</a></li>

                                                        @if ($oContact->status == 1 && $oContact->globalStatus == 1)
                                                            ?><li><a class='changeModuleContactStatus' data-modulesubscriberid="<?php echo $oContact->id; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>" data_status = '0'><i class='icon-file-locked'></i> Inactive</a></li>
                                                        @else
                                                            <li><a class='@if ($oContact->globalStatus == 1) changeModuleContactStatus @else changeModuleContactStatusDisabled @endif'  data-modulesubscriberid="{{ $oContact->id }}" data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}" data_status = '1'><i class='icon-file-locked'></i> Active</a></li>
                                                        @endif

                                                        <li><a class="deleteModuleSubscriber" data-modulesubscriberid="{{ $oContact->id }}" data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}" csrf_token="{{ csrf_token() }}" href="javascript:void(0);"><i class="icon-trash"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>

                                            <td style="display:none;">{{ $oContact->status == 1 ? 'active' : 'archive' }}</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        @else
							<table class="table datatable-basic">
                                    <thead>
                                        <tr>
                                            <th style="display: none"></th>
                                            <th style="display: none"></th>
                                            <th><i class="icon-user"></i>Advocate</th>
                                            <th><i class="icon-calendar"></i>Programs</th>
                                            <th><i class="icon-user"></i>Email</th>
                                            <th><i class="icon-envelop"></i>Created</th>
                                            <th><i class="icon-warning2"></i>Visits</th>
                                            <th><i class="icon-warning2"></i>Sales</th>
                                            <th>Status</th>
                                            <th>Action</th>

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
                                                            Looks Like You Don’t Have Any Advocate Yet <img src="{{ base_url('assets/images/smiley.png') }}"> <br>
                                                            Lets Create Your First Advocate.
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
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                    </tbody>
                                </table>
							@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->
</div>


<script src="{{ base_url() }}assets/js/modules/people/subscribers.js" type="text/javascript"></script>
<script>
    // top navigation fixed on scroll and side bar collasped

    var tableId = 'advocatesTable';
    var tableBase = custom_data_table(tableId);

    $(document).ready(function () {

        // Setup - add a text input to each footer cell
        $('#advocatesTable thead tr').clone(true).appendTo('#advocatesTable thead');
        $('#advocatesTable thead tr:eq(1) th').each(function (i) {
            if (i === 11) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" />');
                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase.column(i).search(this.value, $('#colStatus').prop('checked', true)).draw();
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

        setTimeout(function () {
            $('#activeAdvocates').trigger('click');
        }, 100);

        $('#advocatesTable thead tr:eq(1)').hide();

    });
</script>
@endsection