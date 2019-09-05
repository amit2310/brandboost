@php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign'); @endphp
<div class="tab-pane {{ $campaign }}" id="right-icon-tab4">
	@include('admin.workflow2.workflow_subscribers')
</div>
