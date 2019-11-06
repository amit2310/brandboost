@if (!empty($oCampaignLists))
    @foreach ($oCampaignLists as $oRec)
        <button class="tag_btn"><i class=""><img src="/assets/images/list-check.svg"/></i> {{ $oRec->list_name }}</button>
    @endforeach
@endif

@php
$aSelectedTags = array();
$bSummaryExclude = !empty($bSummaryExclude) ? $bSummaryExclude : false;
if (!empty($oCampaignTags)) {
    //pre($oCampaignTags);
    foreach ($oCampaignTags as $oRec) {
        $aSelectedTags[] = $oRec->tag_id;
    }
    foreach ($aTags as $oTag) {
        if (in_array($oTag->tagid, $aSelectedTags)){
            @endphp
            <button class="tag_btn"><i class=""><img src="/assets/images/price-tag-3-fill.svg"/></i> {{ $oTag->tag_name }}</button>
            @php
        }
    }
}
@endphp

@if (!empty($oCampaignSegments))
    @foreach ($oCampaignSegments as $oRec)
        <button class="tag_btn"><i class=""><img src="/assets/images/blue_filter.png"/></i> {{ $oRec->segment_name }}</button>
    @endforeach
@endif


@if (!empty($oCampaignContacts))
    <button class="tag_btn"><i class=""><img src="/assets/images/user_icon_10.png"/></i> {{ count($oCampaignContacts) }} Contacts</button>
@endif

@if ($bSummaryExclude != true)
    <button class="btn btn-xs btn_white_table remove circle viewBroadcastExcludeOptionSmartPopup" broadcast-id="{{ $broadcastID }}"><img class="plusicon" src="{{ base_url() }}assets/images/red_plus.png"/></button>
@endif



