@php
if ($activeTab == 'Design Template Edit') {
    $activeDesign = 'active';
} else if ($activeTab == 'Settings') {

    $activeSetting = 'active';
} else if ($activeTab == 'Campaign Summary') {

    $activeSummary = 'active';
} else if ($activeTab == 'Choose Template') {

    $activeChoose = 'active';
} else if ($activeTab == 'Select List') {

    $activeSelect = 'active';
} else if ($activeTab == 'Review Contacts') {
    $activeReviewContacts = 'active';
    
}else if ($activeTab == 'Report') {
    $activeReport = 'active';
    
} else {
    $activeSelect = 'active';
}
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="white_box broadcast_menu">
            <ul>
                @if($bExpired == false)
                <li>
                    <a class="{{ strtolower($oBroadcast->campaign_type) }}_add_contact {{ $activeSelect }} continueButton" tab="Select List" href="javascript:void(0);">
                        Add Contacts
                    </a>
                </li>
                @endif
                <li>
                    <a class="{{ strtolower($oBroadcast->campaign_type) }}_review_contact {{ $activeReviewContacts }} continueButton" tab="Review Contacts" href="javascript:void(0);">
                       Review Contacts
                    </a>
                </li>
                @if($bExpired == false)
                <li>
                    <a class="{{ strtolower($oBroadcast->campaign_type) }}_template {{ $activeChoose }} continueButton" tab="Choose Template" href="javascript:void(0);">
                        {{ (strtolower($oBroadcast->campaign_type) == 'sms')? 'SMS' : 'Email' }} Template
                    </a>
                </li>
                <li>
                    <a class="{{ strtolower($oBroadcast->campaign_type) }}_editor {{ $activeDesign }} continueButton" tab="Design Template Edit" href="javascript:void(0);">
                        {{ (strtolower($oBroadcast->campaign_type) == 'sms')? 'SMS' : 'Email' }} Editor
                    </a>
                </li>
                <li>
                    <a class="{{ strtolower($oBroadcast->campaign_type) }}_configuration {{ $activeSetting }} continueButton" tab="Settings" href="javascript:void(0);">
                        Configuration
                    </a>
                </li>
                @endif
                <li>
                    <a class="{{ strtolower($oBroadcast->campaign_type) }}_summary {{ $activeSummary }} continueButton" tab="Campaign Summary" href="javascript:void(0);">
                        Summary
                    </a>
                </li>                
            </ul>
        </div>
    </div>
</div>