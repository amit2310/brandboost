<?php

if ($template_slug == 'referral_invite_sms') {
    $this->load->view("admin/modules/referral/referral-templates/sms/referral-invite-sms");
} elseif ($template_slug == 'referral_invite_reminder_sms') {
    $this->load->view("admin/modules/referral/referral-templates/sms/referral-invite-reminder-sms");
} else if ($template_slug == 'referral_sale_sms') {
    $this->load->view("admin/modules/referral/referral-templates/sms/referral-sale-sms");
} elseif ($template_slug == 'referral_sale_reminder_sms') {
    $this->load->view("admin/modules/referral/referral-templates/sms/referral-sale-reminder-sms");
} else {
    
}
?>
