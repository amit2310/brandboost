@if ($template_slug == 'onsite_review_email')     
    @include('admin.brandboost.brand-templates.onsite.email.onsite-review')
@elseif ($template_slug == 'onsite_review_reminder_email')
    @include('admin.brandboost.brand-templates.onsite.email.onsite-review-reminder')
@elseif ($template_slug == 'onsite_review_thankyou_email')    
    @include('admin.brandboost.brand-templates.onsite.email.onsite-review-thankyou')
@else
@endif