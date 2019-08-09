<?php

if ($template_slug == 'offsite_review_sms') {
    ?>
    @include('admin.brandboost.brand-templates.offsite.sms.offsite-review')
    <?php
} elseif ($template_slug == 'offsite_review_reminder_sms') { 
    ?>
    @include('admin.brandboost.brand-templates.offsite.sms.offsite-review-reminder')
    <?php
} elseif ($template_slug == 'offsite_review_thankyou_sms') {
    ?>
    @include('admin.brandboost.brand-templates.offsite.sms.offsite-review-thankyou')
    <?php
} else {
    
}
?>
