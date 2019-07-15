<div class="wfconfig bbot mb-15 pb-15">
    <ul>
        <li><small>Sent</small> <strong><a href="javascript:void(0);" class="<?php if ($processed > 0): ?>createSegment<?php endif; ?>" segment-type="total-sent" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="email" title="click to create segment"><?php echo $processed; ?></a></strong></li>
        <li><small>Delivered</small> <strong><a href="javascript:void(0);" class="<?php if ($delivered > 0): ?>createSegment<?php endif; ?>" segment-type="total-deliver" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="email" title="click to create segment"><?php echo $delivered; ?></a></strong></li>
        <li><small>Open</small> <strong><a href="javascript:void(0);" class="<?php if ($open > 0): ?>createSegment<?php endif; ?>" segment-type="total-open" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="email" title="click to create segment"><?php echo $open; ?></a></strong></li>
    </ul>
    <div class="clearfix"></div>
</div>

<div class="wfconfig">
    <ul>
        <li><small>Click</small> <strong><a href="javascript:void(0);" class="<?php if ($click > 0): ?>createSegment<?php endif; ?>" segment-type="total-click" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="email" title="click to create segment"><?php echo $click; ?></a></strong></li>
        <li><small>Bounce</small> <strong><a href="javascript:void(0);" class="<?php if ($bounce > 0): ?>createSegment<?php endif; ?>" segment-type="total-bounce" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="email" title="click to create segment"><?php echo $bounce; ?></a></strong></li>
        <li><small>Dropped</small> <strong><a href="javascript:void(0);" class="<?php if ($dropped > 0): ?>createSegment<?php endif; ?>" segment-type="total-dropped" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="email" title="click to create segment"><?php echo $dropped; ?></a></strong></li>
        <li><small>Unsubscribe</small> <strong><a href="javascript:void(0);" class="<?php if ($unsubscribe > 0): ?>createSegment<?php endif; ?>" segment-type="total-unsubscribe" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="email" title="click to create segment"><?php echo $unsubscribe; ?></a></strong></li>
        <li><small>Spam report</small> <strong><a href="javascript:void(0);" class="<?php if ($spamReport > 0): ?>createSegment<?php endif; ?>" segment-type="total-spam-report" campaign-id="<?php echo $moduleUnitID; ?>" event-id="<?php echo $eventID;?>" campaign-type="email" title="click to create segment"><?php echo $spamReport; ?></a></strong></li>
    </ul>
    <div class="clearfix"></div>
</div>