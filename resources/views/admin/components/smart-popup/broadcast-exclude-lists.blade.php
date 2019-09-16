@php
	$aListIDs = array();
	if (!empty($oAutomationLists)) {
		foreach ($oAutomationLists as $oAutomationList) {
			$aListIDs[] = $oAutomationList->list_id;
		}
	}

	$newolists = array();

	foreach ($oLists as $key => $value) {
		$newolists[$value->id][] = $value;
	}
@endphp
<style>
    .box .table > tbody > tr > td {
        padding: 15px 15px 15px 15px !important;
    }
    .dataTables_paginate{margin-bottom: 0px!important}
</style>
<div class="col-md-12"> <a style="left: 30px; top: 15px;" class="reviews smart-broadcast-export-back slide-toggle bkg_grey_light" ><i class=""><img src="{{ base_url() }}assets/images/icon_arrow_right.png"/></i></a>
    <h5 style="padding-left: 60px;" class="panel-title">Exclude from List <span id="totalListContactCount"> {{ $totalSubscribers }} </span></h5>
    <div style="margin-top: -13px;" class="heading-elements">
        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
            <input class="form-control input-sm cus_search" tableID="listSmartContacts" placeholder="Search by name" type="text">
            <div class="form-control-feedback"> <i class=""><img src="{{ base_url() }}assets/images/icon_search.png" width="14"></i> </div>
        </div>
        <div class="table_action_tool"> <a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="{{ base_url() }}assets/images/icon_refresh.png"></i></a> <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_calender.png"></i></a> <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_download.png"></i></a> <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_upload.png"></i></a> <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_edit.png"></i></a> </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-flat">
        <div class="p0 bkg_white bbot">
            <table class="table" id="listSmartContacts">
                <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th style="display: none;"></th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_list_small.png"></i>List</th>
                        <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Contacts</th>
                        <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_created.png"></i>Created</th>
                        <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_action.png"></i>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    foreach ($newolists as $oList):
                        if (!empty($oList[0]->l_list_id)) {
                            $totAll = count($oList);
                        } else {
                            $totAll = 0;
                        }
                        $oList = $oList[0];
                        @endphp
                        <tr>
                            <td style="display: none;">{{ date('m/d/Y', strtotime($oList->list_created)) }}</td>
                            <td style="display: none;">{{ $oList->id }}</td>
                            <td>
                                <div class="media-left brig pr10">
                                    <label class="custmo_checkbox ">
                                        <input type="checkbox" class="updateExcludeList" name="list_id[]" value="{{ $oList->id }}" @if (in_array($oList->id, $aListIDs)) checked="checked" @endif>
                                        <span class="custmo_checkmark sblue"></span> 
                                    </label>
                                </div>
                                <div class="media-left media-middle pl10"> 
                                    <a class="icons s24" href="#"><img src="{{ base_url() }}assets/images/icon_list.png" class="img-circle img-xs" alt=""></a>
                                </div>
                                <div class="media-left">
                                    <div class=""><a href="javascript:void(0);" class="text-default text-semibold">{{ $oList->list_name }}</a> </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="media-left text-right pull-right">
                                    <div class=""><a href="#" class="txt_grey">{{ $totAll }}</a> </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="media-left text-right pull-right">
                                    <div class=""><a href="#" class="txt_grey">{{ dataFormat($oList->list_created) }} <span class="txt_grey">{{ date('h:i A', strtotime($oList->list_created)) }}</span></a> </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="media-left pull-right">
                                    <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><img src="{{ base_url() }}assets/images/more.svg"></a>
                                        <ul class="dropdown-menu dropdown-menu-right more_act">
                                            <a href="#" class="dropdown_close">X</a>

                                            <li><a href="javascript:void(0);" list_id="{{ $oList->id }}" class="importModuleContact" data-modulename="list" data-moduleaccountid="{{ $oList->id }}" data-redirect="{{ base_url() }}admin/broadcast/edit/{{ $oList->id }}"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                            <li><a href="{{ base_url() }}admin/subscriber/exportSubscriberCSV?module_name=list&module_account_id={{ $oList->id }}" list_id="{{ $oList->id }}" class="exportContact" data-modulename="list" data-moduleaccountid="{{ $oList->id }}"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                            <li><a href="javascript:void(0);"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                            <li><a href="javascript:void(0);" list_id="{{ $oList->id }}" class="deletelist"><i class="icon-bin"></i> Delete</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>