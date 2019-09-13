@php
$aSelectedContacts = array();
if (!empty($oCampaignContacts)) {
    foreach ($oCampaignContacts as $oRec) {
        $aSelectedContacts[] = $oRec->subscriber_id;
    }
}

$iActiveCount = $iArchiveCount = 0;
if (!empty($oBroadcastSubscriber)) {
    foreach ($oBroadcastSubscriber as $oCount) {
        if ($oCount->status == 2) {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}
@endphp
<div class="row contactSection"
    @if (empty($activeTab) && empty($oBroadcast->audience_type))
        {!! 'style="display:none;"' !!}
    @endif
    >
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading pt0 pb0">
                <div class="row">
                    <div class="col-md-6 brig h56"><h6 class="panel-title mt17"><img class="hicon" src="{{ base_url() }}assets/images/icon_import.png"/> Add Contacts</h6></div>
                    <div class="col-md-6 pl20 h56"><h6 class="panel-title mt17"><img class="hicon" src="{{ base_url() }}assets/images/icon_cross.png"/> Exclude Contacts</h6></div>
                </div>
            </div>


            <div class="panel-body p0 bkg_white">
                <div class="row">
                    <div class="col-md-6 brig"><div class="p20 taggroup" id="importPropertyButtons">
                            {!! $sImportButtons !!}
                        </div></div>
                    <div class="col-md-6"><div class="p20 pl10 taggroup" id="excludePropertyButtons">
                            {!! $sExcludButtons !!}
                        </div></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row contactSection" id="contactSection"
    @if (empty($activeTab) && empty($oBroadcast->audience_type))
        {!! 'style="display:none;"' !!}
    @endif>
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <span class="pull-left">
                    <h6 class="panel-title"><span id="totalBroadcastAudience">{{ $iActiveCount }}</span> Contacts</h6>
                </span>

                <div class="heading-elements">
                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                        <input class="form-control input-sm cus_search" tableID="broadcastAudience"  placeholder="Search by name" type="text">
                        <div class="form-control-feedback">
                            <i class=""><img src="{{ base_url() }}assets/images/icon_search.png" width="14"></i>
                        </div>

                    </div>
                    <div class="table_action_tool">
                        <a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="{{ base_url() }}assets/images/icon_refresh.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_calender.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_download.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img src="{{ base_url() }}assets/images/icon_upload.png"></i></a>
                        <a href="javascript:void(0);" class="editDataListContact"><i class="icon-pencil"></i></a>
                        <a href="javascript:void(0);" style="display: none;" class="custom_action_box_con deleteBulkBoradcastAudience" broadcast_id="{{ $oBroadcast->broadcast_id }}"><i class="icon-trash position-left"></i></a>
                    </div>
                </div>
            </div>

            <div class="panel-body p0 bkg_white">
                <div id="liveBroadcastAudience">
                    @include('admin.broadcast.partials.broadcast_audience', ['recordSource' => 'contact-selection'])
                </div>
            </div>
        </div>
    </div>
</div>
