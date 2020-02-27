@if ($template_slug == 'onsite_review_sms')
    @include('admin.brandboost.brand-templates.onsite.sms.onsite-review')
@elseif ($template_slug == 'onsite_review_reminder_sms')
    @include('admin.brandboost.brand-templates.onsite.sms.onsite-review-reminder')
@else ($template_slug == 'onsite_review_thankyou_sms')
    @include('admin.brandboost.brand-templates.onsite.sms.onsite-review-thankyou')
@endif
