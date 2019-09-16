@php
    $aSelectedContacts = array();
    $oCampaignContacts = $aContactSelectionData['oCampaignExcludeContacts'];
    if (!empty($oCampaignContacts)) {
        foreach ($oCampaignContacts as $oRec) {
            $aSelectedContacts[] = $oRec->subscriber_id;
        }
    }

    $iActiveCount = $iArchiveCount = 0;
    $subscribersData = $aContactSelectionData['subscribersData'];

    if (!empty($subscribersData)) {
        foreach ($subscribersData as $oCount) {
            if ($oCount->status == 2) {
                $iArchiveCount++;
            } else {
                $iActiveCount++;
            }
        }
    }
@endphp
<div class="panel panel-flat wfSwitchMenu" id="wfExcludeFromContactList" style="display:none;">
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
                <h3 class="fsize20 fw500 txt_dark m0">Exclude From Contacts <span
                        id="totalExcludeContactCount">{{ count($aSelectedContacts) }}</span></h3>

            </div>
            <div class="alert alert-danger" id="validateAddedContacts" style="display:none;">You did not add any
                contacts yet
            </div>


            <div class="p0">

                <table class="table" id="listExcludeContacts">
                    <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th style="display: none;"></th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Contact Name</th>


                    </tr>
                    </thead>
                    <tbody>
                    @php
                        if (count($subscribersData) > 0) {
                            foreach ($subscribersData as $oContact) {
                                $userData = '';
                                if ($oContact->status != '2') {

                                    if ($oContact->user_id > 0) {
                                        $userData = App\Models\Admin\UsersModel::getUserInfo($oContact->user_id);
                                    }
                    @endphp

                    <tr role="row">
                        <td style="display: none;">{{ date('m/d/Y', strtotime($oContact->created)) }}</td>
                        <td style="display: none;" class="sorting_1">{{ $oContact->subscriber_id }}</td>
                        <td>
                            <div class="media-left brig pr10">
                                <label class="custmo_checkbox ">
                                    <input type="checkbox" name="checkRows[]" class="addToExcludeCampaign"
                                           value="{{ $oContact->subscriber_id }}"
                                           @if (in_array($oContact->subscriber_id, $aSelectedContacts))
                                           checked="checked"
                                        @endif
                                    >
                                    <span class="custmo_checkmark sblue"></span>
                                </label>
                            </div>
                            <div
                                class="media-left media-middle"> {!! @showUserAvtar($userData->avatar, $oContact->firstname, $oContact->lastname) !!} </div>
                            <div class="media-left">
                                <div class="pt-5"><a href="javascript:void(0);"
                                                     class="text-default text-semibold bbot">{{ $oContact->firstname }} {{ $oContact->lastname }} </a>
                                    <img class="flags"
                                         src="{{ base_url() }}assets/images/flags/{{ strtolower($oContact->country_code) }}.png"
                                         onerror="this.src='{{ base_url() }}assets/images/flags/us.png'"></div>
                                <div class="text-muted text-size-small">{{ $oContact->email }}</div>
                            </div>
                        </td>

                    </tr>

                    @php
                        }
                    }
                }
                    @endphp


                    </tbody>
                </table>

            </div>


        </div>
    </div>


</div>
<script>
    var tableId = 'listExcludeContacts';
    custom_data_table(tableId);
</script>
