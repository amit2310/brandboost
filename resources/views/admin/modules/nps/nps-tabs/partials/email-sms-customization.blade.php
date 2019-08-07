<style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
    #canvas, #canvas2{height: 250px!important;}
    .rating_widget { min-height: 1000px !important;}

</style>

<div class="col-md-9">
    <?php if ($oNPS->platform == 'email'): ?>
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title pull-left display-inline-block">Email desktop</h6>

            </div>
            <div class="panel-body p0">
                <div class="widget_sec email_preview">
                    <div class="rating_widget emil_priview_sec">
                        <?php echo $emailPreview; ?>
                    </div>
                    <img class="w100" src="<?php echo base_url(); ?>assets/images/config_bkg.png"/>    
                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php if ($oNPS->platform == 'sms'): ?>
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">SMS Preview</h6>
            </div>
            <div class="panel-body p0">
                <div class="sms_preview">
                    <div class="phone_sms">
                        <div class="inner">
                            <p><?php echo $smsPreview; ?></p>
                        </div>
                        <p><small><?php echo date("h:i, d/m/Y"); ?></small></p>
                    </div>

                </div>

            </div>
        </div>
   
    <?php endif; ?>     


</div>