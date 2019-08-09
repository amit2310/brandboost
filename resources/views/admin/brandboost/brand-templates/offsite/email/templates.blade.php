<?php

if ($template_slug == 'offsite_review_email') {
    ?>
    @include('admin.brandboost.brand-templates.offsite.email.offsite-review')
    <?php
} elseif ($template_slug == 'offsite_review_reminder_email') { 
    ?>
    @include('admin.brandboost.brand-templates.offsite.email.offsite-review-reminder')
    <?php
} elseif ($template_slug == 'offsite_review_thankyou_email') {
    ?>
    @include('admin.brandboost.brand-templates.offsite.email.offsite-review-thankyou')
    <?php
} else {
    
}
?>