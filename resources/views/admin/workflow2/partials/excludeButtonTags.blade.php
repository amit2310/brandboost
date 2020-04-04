@if (!empty($oCampaignLists))
    @foreach ($oCampaignLists as $oRec)
        <span class="addtags"><i class="ri-menu-2-fill"></i> {{ $oRec->list_name }} <a class="closetags"><i class="ri-close-circle-fill"></i></a></span>
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
<span class="addtags"><i class="ri-price-tag-3-fill"></i> {{ $oTag->tag_name }} <a class="closetags"><i class="ri-close-circle-fill"></i></a></span>
@php
    }
}
}
@endphp

@if (!empty($oCampaignSegments))
    @foreach ($oCampaignSegments as $oRec)
        <span class="addtags"><i class="ri-pie-chart-fill"></i> {{ $oRec->segment_name }} <a class="closetags"><i class="ri-close-circle-fill"></i></a></span>
    @endforeach
@endif


@if (!empty($oCampaignContacts))
    <span class="addtags"><i class=""><img src="/assets/images/user_icon_10.png"/></i> {{ count($oCampaignContacts) }} Contacts <a class="closetags"><i class="ri-close-circle-fill"></i></a></span>
@endif

@if ($bSummaryExclude != true)
    <button class="btn btn-xs btn_white_table remove circle viewWorkflowExcludeOptionSmartPopup" style="display: none;"
            moduleUnitID="{{ $moduleUnitID }}"><img class="plusicon" src="{{ base_url() }}assets/images/red_plus.png"/>
    </button>
@endif
