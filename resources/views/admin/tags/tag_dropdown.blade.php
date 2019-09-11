<div class="tdropdown">
    <button type="button" class="btn btn-xs btn_white_table bluee dropdown-toggle" data-toggle="dropdown">
        {{ count($oTags) }} Tags <span class="caret"></span>
    </button>

    <ul class="dropdown-menu dropdown-menu-right tagss">
        @if (count($oTags) > 0)
            @foreach ($oTags as $oTag)
                <button class="btn btn-xs btn_white_table pr10"> {{ $oTag->tag_name }} </button>
            @endforeach
        @endif

        <button class="btn btn-xs plus_icon ml10 {{ $actionClass }}" {{ $fieldName }}="{{ $fieldValue }}" action_name=
        "{{ $actionName }}">
        <i class="icon-plus3"></i>
        </button>
    </ul>
    <button class="btn btn-xs plus_icon ml10 {{ $actionClass }}" {{ $fieldName }}="{{ $fieldValue }}" action_name=
    "{{ $actionName }}">
    <i class="icon-plus3"></i>
    </button>
</div>

