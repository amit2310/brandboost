<?php
if ($template_slug == 'referral_invite_email') {
    $this->load->view("admin/modules/referral/referral-templates/email/referral-invite-email");
} elseif ($template_slug == 'referral_invite_reminder_email') {
    $this->load->view("admin/modules/referral/referral-templates/email/referral-invite-reminder-email");
}else if ($template_slug == 'referral_sale_email') {
    $this->load->view("admin/modules/referral/referral-templates/email/referral-sale-email");
} elseif ($template_slug == 'referral_sale_reminder_email') {
    $this->load->view("admin/modules/referral/referral-templates/email/referral-sale-reminder-email");
} else {
    
}
?>

