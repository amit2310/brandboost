<div class="tab-pane <?php echo ($defalutTab == 'people') ? 'active' : ''; ?>" id="right-icon-tab4">
    @include('admin.workflow2.workflow_subscribers')


    <div class="row pull-right">
        <div class="col-md-12">
            <a href="<?php echo base_url("/admin/modules/nps/setup/{$programID}?t=score") ?>" class="btn dark_btn mt30">Continue</a>
        </div>
    </div>

</div>

