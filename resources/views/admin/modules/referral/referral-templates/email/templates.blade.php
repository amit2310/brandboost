<?php
if ($template_slug == 'referral_invite_email') {
    ?>
    @include('admin.modules.referral.referral-templates.email.referral-invite-email')
    <?php
} elseif ($template_slug == 'referral_invite_reminder_email') {
    ?>
    @include('admin.modules.referral.referral-templates.email.referral-invite-reminder-email')
    <?php
} else if ($template_slug == 'referral_sale_email') {
    ?>
    @include('admin.modules.referral.referral-templates.email.referral-sale-email')
    <?php
} elseif ($template_slug == 'referral_sale_reminder_email') {
    ?>
    @include('admin.modules.referral.referral-templates.email.referral-sale-reminder-email')
    <?php
} else {
    
}
?>

