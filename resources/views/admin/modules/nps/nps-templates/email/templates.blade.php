<?php
if ($template_slug == 'nps_email_invite') {
    $this->load->view("admin/modules/nps/nps-templates/email/nps-email");
} elseif ($template_slug == 'nps_email_link_invite') {
    $this->load->view("admin/modules/nps/nps-templates/email/nps-link");
} else {
    
}
?>