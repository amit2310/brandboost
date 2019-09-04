@if ($template_slug == 'nps_email_invite')
    @include('admin.modules.nps.nps-templates.email.nps-email')
@elseif ($template_slug == 'nps_email_link_invite')
    @include('admin.modules.nps.nps-templates.email.nps-link')
@endif