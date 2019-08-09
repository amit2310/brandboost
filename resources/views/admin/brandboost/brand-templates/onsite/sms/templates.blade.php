<?php

if ($template_slug == 'onsite_review_sms') {
    ?>
    @include('admin.brandboost.brand-templates.onsite.sms.onsite-review')
    <?php
} elseif ($template_slug == 'onsite_review_reminder_sms') { 
    ?>
    @include('admin.brandboost.brand-templates.onsite.sms.onsite-review-reminder')
    <?php
} elseif ($template_slug == 'onsite_review_thankyou_sms') {
    ?>
    @include('admin.brandboost.brand-templates.onsite.sms.onsite-review-thankyou')
    <?php
} else {
    
}
?>