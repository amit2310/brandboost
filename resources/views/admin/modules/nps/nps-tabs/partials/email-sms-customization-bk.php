<style>
    .phone_sms{background:url('<?php echo base_url(); ?>assets/images/iphone.png') center top no-repeat; margin: 40px auto 10px; width: 357px; height: 716px; padding: 80px 40px;}
    .phone_sms .inner{ background: #ebece7; padding: 15px; font-size: 13px; border-radius:0 12px 12px; margin-bottom: 10px;}
    .phone_sms .inner p{margin: 0;}
</style>

<div class="col-md-9">
    <?php if ($oNPS->platform == 'email'): ?>
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Email Preview</h6>
            </div>
            <div class="panel-body">
                <div class="email_preview">

                    <div style="display:none;"><textarea name="emailPreviewData" id="emailPreviewData"></textarea></div>
                    <div class="emil_priview_sec">
                        <?php echo $emailPreview; ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="panel panel-flat mb30">
            <div class="panel-heading">
                <h6 class="panel-title">SMS Preview</h6>
            </div>
            <div class="panel-body">
                <div class="sms_preview">
                    <div class="phone_sms">
                        <div class="inner">
                            <p class="questionSMSText"><?php echo $smsPreview; ?></p>
                        </div>
                        <p><small><?php echo date("h:i, d/m/Y"); ?></small></p>
                    </div>

                </div>

            </div>
        </div>


    <?php endif; ?>

    <?php if ($oNPS->platform == 'sms'): ?>
        <div class="panel panel-flat mb30">
            <div class="panel-heading">
                <h6 class="panel-title">SMS Preview</h6>
            </div>
            <div class="panel-body">
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
    
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Email Preview</h6>
            </div>
            <div class="panel-body">
                <div class="email_preview">

                    <div style="display:none;"><textarea name="emailPreviewData" id="emailPreviewData"></textarea></div>
                    <div class="emil_priview_sec">
                        <?php echo $emailPreview; ?>
                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>     


</div>