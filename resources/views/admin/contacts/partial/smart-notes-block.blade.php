@if (!empty($oNotes))
    @foreach ($oNotes as $key => $noteData)
        <p class="txt_grey2 fsize13 lh24 bbot">
            {{ $noteData->notes }}
            <br>
            <small class="text-muted">On {{ date('F d, Y h:i A', strtotime($noteData->created)) }}
                by {{ $noteData->firstname . ' ' . $noteData->lastname }}</small>
        </p>

    @endforeach
@else
    <div class="text-center mt10">{!! displayNoData() !!}</div>
@endif


