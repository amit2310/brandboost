<div class="tab-pane <?php echo $emailWorkflow; ?>" id="right-icon-tab3">
    <?php //$this->load->view("admin/workflow2/tree", array("oEvents" => $oEvents)); ?>
	@include('admin.workflow2.tree', array("oEvents" => $oEvents))
    <div class="col-md-12 text-right">
    </div>    
</div>
