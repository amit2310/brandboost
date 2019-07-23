<div class="tab-pane <?php echo $allStatus; ?> show_email_report" id="right-icon-tab1">
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <?php $this->load->view("admin/broadcast/reports/subscriber-data", array('tableId'=>$tableId)); ?>
            </div>
        </div>
    </div>
</div>
