<?php

if ($template_slug == 'onsite_review_email') {
    ?>
    @include('admin.brandboost.brand-templates.onsite.email.onsite-review')
    <?php
} elseif ($template_slug == 'onsite_review_reminder_email') { 
    ?>
    @include('admin.brandboost.brand-templates.onsite.email.onsite-review-reminder')
    <?php
} elseif ($template_slug == 'onsite_review_thankyou_email') {
    ?>
    @include('admin.brandboost.brand-templates.onsite.email.onsite-review-thankyou')
    <?php
} else {
    
}
?>