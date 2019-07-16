<div class="wfconfig">
    <ul>
        <li><small>Sent</small> <strong><a href="javascript:void(0);" class="<?php if ($sentSms > 0): ?>createSegment<?php endif; ?>" segment-type="total-sent" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="sms" title="click to create segment"><?php echo $sentSms; ?></a></strong></li>
        <li><small>Delivered</small> <strong><a href="javascript:void(0);" class="<?php if ($deliveredSms > 0): ?>createSegment<?php endif; ?>" segment-type="total-deliver" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="sms" title="click to create segment"><?php echo $deliveredSms; ?></a></strong></li>
        <li><small>Failed</small> <strong><a href="javascript:void(0);" class="<?php if ($failedSms > 0): ?>createSegment<?php endif; ?>" segment-type="total-fail" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="sms" title="click to create segment"><?php echo $failedSms; ?></a></strong></li>
        <li><small>Queued</small> <strong><a href="javascript:void(0);" class="<?php if ($queuedSms > 0): ?>createSegment<?php endif; ?>" segment-type="total-queue" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="sms" title="click to create segment"><?php echo $queuedSms; ?></a></strong></li>
        
    </ul>
    <div class="clearfix"></div>
</div>