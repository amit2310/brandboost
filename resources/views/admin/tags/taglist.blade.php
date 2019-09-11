<div class="row">
    <div class="col-lg-6 text-left"><h4 class="text-center">Tags</h4></div>
    <div class="col-lg-6 text-right" style="margin-top:7px;">
        <button  id="addTagEntity" type="button" class="btn bl_cust_btn btn-default"><i class="icon-make-group position-left"></i> ADD TAG</button>
	</div>
</div>
	@if (!empty($aTags))
		@foreach ($aTags as $oData)
			<p style="padding:10px;border-bottom: 1px solid #ccc;"><strong><a href="javascript:void(0);" tagID="{{ $oData->id }}">{{ $oData->tag_name }}</a></strong><div style="text-align:right;width:50px;float:right;margin-top:-40px;"><ul class="icons-list">  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="javascript:void(0);" class="editTagGroupEntity" tagid="{{ $oData->id }}" groupid="{{ $oData->group_id }}" ><i class="icon-file-stats"></i> Edit</a></li>
					<li><a href="javascript:void(0);" class="deleteTagGroupEntity" tagid="{{ $oData->id }}" groupid="{{ $oData->group_id }}"><i class="icon-file-text2"></i> Delete</a></li>
				</ul>
			</li>
			</ul></div></p>
		@endforeach
	@else
		<p style="padding:10px;text-align:center;border-top: 1px solid #ccc;"><i>No Tag Found</i></p>
    @endif