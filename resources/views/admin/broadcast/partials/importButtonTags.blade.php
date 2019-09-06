@if (!empty($oCampaignLists)) 
    @foreach ($oCampaignLists as $oRec)        
    <button class="btn btn-xs btn_white_table addtag"><img src="{{ base_url() }}assets/images/blue_line.png" > {{ $oRec->list_name }}</button>
    @endforeach
@endif    

@php
$aSelectedTags = array();
$bSummary = !empty($bSummary) ? $bSummary : false;
if (!empty($oCampaignTags)) {
    //pre($oCampaignTags);
    foreach ($oCampaignTags as $oRec) {
        $aSelectedTags[] = $oRec->tag_id;
    }
    foreach ($aTags as $oTag) {
        if (in_array($oTag->tagid, $aSelectedTags)){
            @endphp
            <button class="btn btn-xs btn_white_table addtag"><img src="{{ base_url() }}assets/images/blue_hash.png"> {{ $oTag->tag_name }}</button>
            @php
        }
    }
}
@endphp

@if (!empty($oCampaignSegments)) 
    @foreach ($oCampaignSegments as $oRec) 
        <button class="btn btn-xs btn_white_table addtag"><img src="{{ base_url() }}assets/images/blue_filter.png"> {{ $oRec->segment_name }}</button>
    @endforeach
@endif    


@if (!empty($oCampaignContacts))   
    <button class="btn btn-xs btn_white_table addtag"><img src="{{ base_url() }}assets/images/user_icon_10.png"> {{ count($oCampaignContacts) }} Contacts</button>
@endif

@if ($bSummary != true)
    <button class="btn btn-xs btn_white_table addtag circle viewBroadcastImportOptionSmartPopup" broadcast-id="{{ $broadcastID }}"><img class="plusicon" src="{{ base_url() }}assets/images/blue_plus.png"/></button>        
@endif


