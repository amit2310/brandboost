<?php
if ($template_slug == 'nps_sms_invite') {
    $this->load->view("admin/modules/nps/nps-templates/sms/nps-sms");
} elseif ($template_slug == 'nps_sms_link_invite') {
    $this->load->view("admin/modules/nps/nps-templates/sms/nps-sms-link");
} else {
    
}
?>