<?php

if ($template_slug == 'referral_invite_sms') {
    ?>
    @include('admin.modules.referral.referral-templates.sms.referral-invite-sms')
    <?php
} elseif ($template_slug == 'referral_invite_reminder_sms') {
    ?>
    @include('admin.modules.referral.referral-templates.sms.referral-invite-reminder-sms')
    <?php
} else if ($template_slug == 'referral_sale_sms') {
    ?>
    @include('admin.modules.referral.referral-templates.sms.referral-sale-sms')
    <?php
} elseif ($template_slug == 'referral_sale_reminder_sms') {
    ?>
    @include('admin.modules.referral.referral-templates.sms.referral-sale-reminder-sms')
    <?php
} else {
    
}
?>
