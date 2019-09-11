<style>
#tagsApplyPopup .active{background:#5d7df3!important; color: #fff!important;}
</style>
@php
	if(!empty($oTags)){
		foreach($oTags as $oTag){
			$aGroup[$oTag->id] = $oTag->group_name;
		}
		
		foreach($aGroup as $iGroupID => $groupName){
			foreach($oTags as $oTag){
				if($oTag->id == $iGroupID){
					$aTagEntity[$iGroupID][] = $oTag;
				}
			}
		}		
	}
	$i=1;
@endphp

@if(!empty($oTags))
	<div class="row" id="tagsApplyPopup">
		@foreach($aTagEntity as $key=>$aGroup)
			<div class="col-md-12">
				<div class="profile_headings" style="margin:0px; {{ $i == 1 ? 'margin-top:-20px; border-top:none;' : '' }}">
					{{ $aGroup[0]->group_name }} 
					<a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a>
				</div>
				<div class="pb0 pt-15">
				@php 
					if(!empty($aGroup)){
						sort($aGroup);
						foreach($aGroup as $aTag){
							@endphp
							@if(!empty($aTag->tagid))
								<input type="checkbox" name="applytag[]" id="allow_comment_{{ $aTag->tagid }}" value="{{ $aTag->tagid }}" class="hidden clsApplyTag" {!! search_in_array(trim($aTag->tag_name), $aAppliedTags) != '' ? 'checked' : '' !!} preview_fname="preview_allow_comments"><label class="btn btn-xs btn_white_table {{ search_in_array(trim($aTag->tag_name), $aAppliedTags) != '' ? 'active' : '' }}" for="allow_comment_{{ $aTag->tagid }}"> {{ $aTag->tag_name }}</label>
							@else						
								<p><i>No Tag Found</i></p>
							@endif
							@php
						}
					}
					$i++;
				@endphp
				</div>	
			</div>
		@endforeach
	</div>
@else
	<br>
	<div style="text-align:center;">
		<p>Whoops, looks like you don't have any tags yet :-(</p>
		<div><a href="{{ base_url('admin/tags/') }}" class="btn bl_cust_btn btn-default">CREATE YOUR FIRST TAG</a></div>
	</div>
	<br><br>
@endif

<script>
$(document).ready(function(){
	$('.clsApplyTag').change(function(){
		if (this.checked) {
			$(this).next().addClass('active');
		}else{
			$(this).next().removeClass('active');
		}
	});
});
</script>