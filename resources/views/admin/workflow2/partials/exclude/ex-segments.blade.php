@php

    $oCampaignSegments = $aContactSelectionData['oCampaignExcludeSegments'];
    $aSelectedSegments = array();
    if (!empty($oCampaignSegments)) {
        foreach ($oCampaignSegments as $oRec) {
            $aSelectedSegments[] = $oRec->segment_id;
        }
    }
@endphp
<div class="panel panel-flat wfSwitchMenu" id="wfExcludeFromSegments" style="display:none;">
    <div class="panel-heading">
        <h6 class="panel-title pull-left"><a style="color: #5e729d!important;" class="backtoExcludeOptionMenu"
                                             href="javascript:void(0);"> <i class=""><img width="20"
                                                                                          src="{{ base_url() }}assets/images/back_icon.png"/></i>
                &nbsp; Back</a></h6>
        <h6 class="panel-title pull-right">Exclude Contacts</h6>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body pt0 bkg_white" style="padding:0;">
        <div class="col-md-12">

            <div class="p20 bbot">
                <h3 class="fsize20 fw500 txt_dark m0">Exclude From Segments <span
                        id="totalExcludeSegmentCount">{{ count($aSelectedSegments) }}</span></h3>

            </div>
            <div class="alert alert-danger" id="validateAddedContacts" style="display:none;">You did not add any
                contacts yet
            </div>


            <div class="p0">

                <table class="table" id="listExcludeSegments">
                    <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th style="display: none;"></th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_list_small.png"></i>Segment Name
                        </th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Contacts</th>


                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $aUser = getLoggedUser();
                        $userID = $aUser->id;
                        $oSegments = $aContactSelectionData['oSegments'];
                        foreach ($oSegments as $oSegment):
                            $oSubscribers = App\Models\Admin\WorkflowModel::getWorkflowSegmentSubscribers($oSegment->id, $userID);
                    @endphp
                    <tr role="row">
                        <td style="display: none;">{{ date('m/d/Y', strtotime($oSegment->created)) }}</td>
                        <td style="display: none;" class="sorting_1">{{ $oSegment->id }}</td>
                        <td>
                            <div class="media-left brig pr10">
                                <label class="custmo_checkbox ">
                                    <input type="checkbox" class="addExcludeSegmentToCampaign" name="checkRows[]"
                                           value="{{ $oSegment->id }}"
                                           @if (in_array($oSegment->id, $aSelectedSegments))
                                           checked="checked"
                                        @endif
                                    >
                                    <span class="custmo_checkmark sblue"></span>
                                </label>
                            </div>
                            <div class="media-left media-middle pl10">
                                <a class="icons s24" href="#"><img src="{{ base_url() }}assets/images/icon_list.png"
                                                                   class="img-circle img-xs" alt=""></a>
                            </div>
                            <div class="media-left">
                                <div class=""><a href="javascript:void(0);"
                                                 class="text-default text-semibold">{{ $oSegment->segment_name }}</a>
                                </div>
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="media-left text-right pull-right">
                                <div class=""><a href="#" class="txt_grey">{{ count($oSubscribers) }}</a></div>
                            </div>
                        </td>

                    </tr>

                    @php
                        endforeach
                    @endphp

                    </tbody>
                </table>

            </div>


        </div>
    </div>


</div>
<script>
    var tableId = 'listExcludeSegments';
    custom_data_table(tableId);
</script>
