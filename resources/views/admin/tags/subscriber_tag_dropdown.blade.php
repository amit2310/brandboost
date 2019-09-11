<button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown"><i class="icon-hash"></i> {{ count($oTags) }} Tags &nbsp; <span class="caret"></span></button>
<ul class="dropdown-menu dropdown-menu-right width-200">
    @if (!empty($oTags))
        @foreach ($oTags as $oTag)
            <li><a href="javascript:void(0);">{{ $oTag->tag_name }}</a>
        @endforeach
    @endif
</ul>
