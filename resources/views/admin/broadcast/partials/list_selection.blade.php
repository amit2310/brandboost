@php
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
<div class="row" id="listSection"
     @if ($oBroadcast->audience_type != 'lists')
     style="display:none;"
    @endif
>
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">


		  	  <span class="pull-left">
			  <h6 class="panel-title">Lists <button class="btn btn-xs btn_white_table pr10 ml10 txt_blue_sky2"
                                                    style="font-weight: 400!important; background: #ebf6fe!important"> <span
                          id="totalListCount">{{ count($aListIDs) }} </span> list added</button>
			  <button class="btn btn-xs btn_white_table pr10 ml10 txt_blue_sky2"
                      style="font-weight: 400!important; background: #ebf6fe!important"><span
                      id="totalListContactCount"> {{ $totalSubscribers }}  </span> contact added</button>
			  <button class="btn btn-xs btn_white_table pr10 ml10 txt_blue_sky2"
                      style="font-weight: 400!important; background: #ebf6fe!important"> <span
                      id="totalListDuplicateCount"> {{ $duplicateSubscriber }} </span> duplicate contact</button>
                  <!--  <a href="javascript:void(0);" class="btn btn-xs btn_white_table pr10 ml10 txt_blue_sky2 selectAudience" >Change Selection</a> -->
				</h6>
			  </span>


                <div class="heading-elements">
                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                        <div class="form-control-feedback">
                            <i class=""><img src="{{ base_url() }}assets/images/icon_search.png"
                                             width="14"></i>
                        </div>
                    </div>
                    <div class="table_action_tool">
                        <a href="javascript:void(0);"
                           class="btn btn-xs btn_white_table pr10 ml10 txt_blue_sky2 selectAudience">Change
                            Selection</a>
                    </div>
                </div>
            </div>
            <div class="panel-body p0 bkg_white">
                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th style="display: none;"></th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_list_small.png"/></i>List
                        </th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"/></i>Contacts
                        </th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_created.png"/></i>Created
                        </th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_email_small.png"/></i>Email
                        </th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_sms.png"/></i>SMS</th>
                    <!-- <th><i class=""><img src="{{ base_url() }}assets/images/icon_out.png"/></i>Out</th> -->
                        <th><i class="icon-calendar"></i>Last Incoming Lead</th>
                        <th class="text-right"><i class=""><img
                                    src="{{ base_url() }}assets/images/icon_action.png"/></i>Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <!--=======================-->
                    @php
                        foreach ($newolists as $oList):
                        $totEmailCount = 0;
                        $totSMSCount = 0;
                        $totUnsubscribeCount = 0;
                        if (!empty($oList[0]->l_list_id)) {
                            $totAll = count($oList);
                        } else {
                            $totAll = 0;
                        }

                        //pre($oList);
                        $lastList = end($oList);
                        //pre($lastList->l_created);
                        if (!empty($lastList->l_created)) {
                            $lastListTime = timeAgo($lastList->l_created);
                        } else {
                            $lastListTime = '<div class="media-left">
                                                  <div class="">
                                                    <span class="text-muted text-size-small">[No Data]</span>
                                                   </div>
                                             </div>';
                        }

                        foreach ($oList as $value) {

                            if (!empty($value->l_email)) {
                                $totEmailCount++;
                            }
                            if (!empty($value->l_phone)) {
                                $totSMSCount++;
                            }
                        }
                        $oList = $oList[0];

                        $totalContacts = $totAll;
                        $totalEmailGraph = 0;
                        $totalSMSGraph = 0;
                        $totalUnsubGraph = 0;

                        $totalEmailGraph = $totEmailCount * 100 / $totalContacts;
                        $totalEmailGraph = ceil($totalEmailGraph);

                        $totalSMSGraph = $totSMSCount * 100 / $totalContacts;
                        $totalSMSGraph = ceil($totalSMSGraph);

                        $totalUnsubGraph = $totUnsubscribeCount * 100 / $totalContacts;
                        $totalUnsubGraph = ceil($totalUnsubGraph);

                    @endphp
                    <tr>
                        <td style="display: none;">{{ date('m/d/Y', strtotime($aTag->tag_created)) }}</td>
                        <td style="display: none;">{{ $aTag->tagid }}</td>
                        <td>
                            <div class="media-left brig pr10">
                                <label class="custmo_checkbox ">
                                    <input type="checkbox" class="updateList" name="list_id[]" id="list_id"
                                           value="{{ $oList->id }}"
                                           @if (in_array($oList->id, $aListIDs))
                                           checked="checked"
                                        @endif >
                                    <span class="custmo_checkmark sblue"></span> </label>
                            </div>
                            <div class="media-left media-middle pl10"><a class="icons s24" href="#"><img
                                        src="{{ base_url() }}assets/images/icon_list.png"
                                        class="img-circle img-xs" alt=""></a></div>
                            <div class="media-left">
                                <div class=""><a href="#"
                                                 class="text-default text-semibold">{{ $oList->list_name }}</a>
                                </div>
                            </div>
                        </td>
                        <td>

                            <div class="media-left">
                                <div class="">
                                    @if($totAll > 0)
                                        <a href="{{ base_url() . 'admin/lists/getListContacts?list_id=' . $oList->id }}"
                                           class="text-default text-semibold"><span
                                                class="txt_grey">{{ $totAll }}</span></a>
                                    @else
                                        <span class="text-muted text-size-small">[No Data]</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="media-left text-right">
                                <div class=""><a href="#"
                                                 class="txt_grey">{{ dataFormat($oList->list_created) }} <span
                                            class="txt_grey">{{ date('h:i A', strtotime($oList->list_created)) }}</span></a>
                                </div>
                            </div>
                        </td>


                        <td>
                            @php
                                $addPC = '';
                                if ($totalEmailGraph > 50) {
                                    $addPC = 'over50';
                                }
                            @endphp
                            <div class="media-left">
                                <div
                                    class="progress-circle {{ $addPC }} green cp{{ $totalEmailGraph }}">
                                    <div class="left-half-clipper">
                                        <div class="first50-bar"></div>
                                        <div class="value-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="media-left">
                                <div data-toggle="tooltip"
                                     title="{{ $totEmailCount }} have email address out of {{ $totalContacts }} contacts"
                                     data-placement="top">
                                    <a href="javascript:void(0);"
                                       class="text-default text-semibold">{{ $totEmailCount }}</a>
                                    @if ($newEmails > 0)
                                        <span style="color:#FF0000;"> ({{ $newEmails }} new)</span>
                                    @endif

                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                                $addPC = '';
                                if ($totalSMSGraph > 50) {
                                    $addPC = 'over50';
                                }
                            @endphp
                            <div class="media-left">
                                <div class="progress-circle {{ $addPC }} grey cp{{ $totalSMSGraph }}">
                                    <div class="left-half-clipper">
                                        <div class="first50-bar"></div>
                                        <div class="value-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="media-left">
                                <div data-toggle="tooltip"
                                     title="{{ $totSMSCount }} have sms out of {{ $totalContacts }} contacts"
                                     data-placement="top">
                                    <a href="javascript:void(0);"
                                       class="text-default text-semibold">{{ $totSMSCount }}</a>
                                    @if ($newSMS > 0)
                                        <span style="color:#FF0000;"> ({{ $newSMS }} new)</span>
                                    @endif

                                </div>
                            </div>

                        </td>

                        <td>{{ $lastListTime }}</td>
                        <td class="text-right">
                            <div class="media-left pull-right">
                                <div class="tdropdown ml10"><a class="table_more dropdown-toggle" data-toggle="dropdown"
                                                               aria-expanded="false"><img
                                            src="{{ base_url() }}assets/images/more.svg"></a>

                                    <ul class="dropdown-menu dropdown-menu-right more_act width-200">
                                        <a href="#" class="dropdown_close">X</a>
                                        <li><a href="javascript:void(0);" list_id="{{ $oList->id }}"
                                               class="addModuleContact" data-modulename="list"
                                               data-moduleaccountid="{{ $oList->id }}"><i
                                                    class="icon-gear"></i> Add Contact</a></li>
                                        <li><a href="javascript:void(0);" list_id="{{ $oList->id }}"
                                               class="importModuleContact" data-modulename="list"
                                               data-moduleaccountid="{{ $oList->id }}"
                                               data-redirect="{{ base_url() }}admin/broadcast/edit/{{ $oList->id }}"><i
                                                    class="icon-gear"></i> Import Contacts</a></li>

                                        <li>
                                            <a href="{{ base_url() }}admin/subscriber/exportSubscriberCSV?module_name=list&module_account_id={{ $oList->id }}"
                                               list_id="{{ $oList->id }}" class="exportContact"
                                               data-modulename="list"
                                               data-moduleaccountid="{{ $oList->id }}"><i
                                                    class="icon-gear"></i> Export Contacts</a>
                                        </li>
                                        <li><a target="_blank"
                                               href="{{ base_url() }}admin/lists/getListContacts?list_id={{ $oList->id }}"><i
                                                    class="icon-gear"></i> View Contacts</a></li>
                                        <li><a href="javascript:void(0);" list_id="{{ $oList->id }}"
                                               class="editlist"><i class="icon-pencil"></i> Edit</a></li>
                                        <li><a href="javascript:void(0);" list_id="{{ $oList->id }}"
                                               class="deletelist"><i class="icon-trash"></i> Delete</a></li>
                                    </ul>

                                </div>
                            </div>
                            <div class="media-left pull-right">
                                <div class="">
                                    <a href="javascript:void(0);" list_id="{{ $oList->id }}"
                                       class="addModuleContact text-default text-semibold bbotb" data-modulename="list"
                                       data-moduleaccountid="{{ $oList->id }}"><span
                                            class="txt_blue_sky2">Add Contacts</span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @php endforeach @endphp
                    <!--=======================-->

                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>



