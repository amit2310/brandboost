<?php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign'); ?>
<div class="tab-pane <?php echo $campaign; ?>" id="right-icon-tab4">
	@include('admin.workflow2.workflow_subscribers')
</div>
