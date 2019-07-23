<?php
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
?>
<div class="row">
    <div class="col-md-12">
        <div class="white_box broadcast_menu">
            <ul>
                <?php if($bExpired == false): ?>
                <li>
                    <a class="<?php echo strtolower($oBroadcast->campaign_type);?>_add_contact <?php echo $activeSelect; ?> continueButton" tab="Select List" href="javascript:void(0);">
                        Add Contacts
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a class="<?php echo strtolower($oBroadcast->campaign_type);?>_review_contact <?php echo $activeReviewContacts; ?> continueButton" tab="Review Contacts" href="javascript:void(0);">
                       Review Contacts
                    </a>
                </li>
                <?php if($bExpired == false): ?>
                <li>
                    <a class="<?php echo strtolower($oBroadcast->campaign_type);?>_template <?php echo $activeChoose; ?> continueButton" tab="Choose Template" href="javascript:void(0);">
                        <?php echo (strtolower($oBroadcast->campaign_type) == 'sms')? 'SMS' : 'Email';?> Template
                    </a>
                </li>
                <li>
                    <a class="<?php echo strtolower($oBroadcast->campaign_type);?>_editor <?php echo $activeDesign; ?> continueButton" tab="Design Template Edit" href="javascript:void(0);">
                        <?php echo (strtolower($oBroadcast->campaign_type) == 'sms')? 'SMS' : 'Email';?> Editor
                    </a>
                </li>
                <li>
                    <a class="<?php echo strtolower($oBroadcast->campaign_type);?>_configuration <?php echo $activeSetting; ?> continueButton" tab="Settings" href="javascript:void(0);">
                        Configuration
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a class="<?php echo strtolower($oBroadcast->campaign_type);?>_summary <?php echo $activeSummary; ?> continueButton" tab="Campaign Summary" href="javascript:void(0);">
                        Summary
                    </a>
                </li>
                <?php if($bExpired == true): ?>
<!--                <li>
                    <a class="<?php echo $activeReport; ?> continueButton" tab="Report" href="javascript:void(0);">
                        <?php if($activeReport): ?>
                        <img src="<?php echo base_url(); ?>assets/images/<?php echo strtolower($oBroadcast->campaign_type);?>_br_icon5<?php echo ($activeReport) ? '_act' : ''; ?>.png">
                        <?php else: ?>
                        <img src="<?php echo base_url(); ?>assets/images/email_br_icon5.png">
                        <?php endif; ?>
                        Report
                    </a>
                </li>-->
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>