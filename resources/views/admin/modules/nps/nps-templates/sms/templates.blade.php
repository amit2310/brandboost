<?php
if ($template_slug == 'nps_sms_invite'): ?>
    @include('admin.modules.nps.nps-templates.sms.nps-sms')
 <?php elseif ($template_slug == 'nps_sms_link_invite'):?>
    @include('admin.modules.nps.nps-templates.sms.nps-sms-link')
<?php endif; ?>