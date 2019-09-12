<div class="wfconfig">
    <ul>
        <li><small>Sent</small> <strong><a href="javascript:void(0);" class="
        @if ($sentSms > 0)
                    createSegment
                    @endif
                    " segment-type="total-sent" campaign-id="{{ $moduleUnitID }}" event-id="{{ $eventID }}"
                                           campaign-type="sms"
                                           title="click to create segment">{{ $sentSms }}</a></strong></li>
        <li><small>Delivered</small> <strong><a href="javascript:void(0);"
                                                class="
                                                @if ($deliveredSms > 0)
                                                    createSegment
                                                    @endif
                                                    "
                                                segment-type="total-deliver" campaign-id="{{ $moduleUnitID }}"
                                                event-id="{{ $eventID }}" campaign-type="sms"
                                                title="click to create segment">{{ $deliveredSms }}</a></strong></li>
        <li><small>Failed</small> <strong><a href="javascript:void(0);"
                                             class="
@if ($failedSms > 0)
                                                 createSegment
                                                 @endif
                                                 "
                                             segment-type="total-fail" campaign-id="{{ $moduleUnitID }}"
                                             event-id="{{ $eventID }}" campaign-type="sms"
                                             title="click to create segment">{{ $failedSms }}</a></strong></li>
        <li><small>Queued</small> <strong><a href="javascript:void(0);"
                                             class="
@if ($queuedSms > 0)
                                                 createSegment
                                                 @endif
                                                 "
                                             segment-type="total-queue" campaign-id="{{ $moduleUnitID }}"
                                             event-id="{{ $eventID }}" campaign-type="sms"
                                             title="click to create segment">{{ $queuedSms }}</a></strong></li>

    </ul>
    <div class="clearfix"></div>
</div>
