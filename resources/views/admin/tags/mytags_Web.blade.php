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
				<div class="profile_headings" style="margin:0px; {{$i == 1 ? 'margin-top:-20px; border-top:none;' : '' }}">{{ $aGroup[0]->group_name }} <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>
					<div class="pb0 pt-15" style="float: left;">
					@php 
						if(!empty($aGroup)){
							sort($aGroup);
							foreach($aGroup as $aTag){
								if(!empty($aTag->tagid)){
									$resultcheck = search_in_array(trim($aTag->tag_name), $aAppliedTags);
								@endphp
									<input type="checkbox" name="applytag[]" id="allow_comment_{{ $aTag->tagid }}" value="{{ $aTag->tagid }}" class="hidden clsApplyTag" {!! $resultcheck != '' ? 'checked' : '' !!} preview_fname="preview_allow_comments"><label class="btn btn-xs btn_white_table {{ $resultcheck != '' ? 'active' : '' }}" for="allow_comment_{{ $aTag->tagid }}"> {{ $aTag->tag_name }}</label>
								@php 
								}else{
									echo '<p><i>No Tag Found</i></p>';
								}
							}
						}
						@endphp
						<a data-group-id="{{ $aTag->id }}" class="btn btn-xs btn_white_table addnewtag" href="javascript:void(0)"><i class="icon-plus3"></i></a>
					</div>
					<span id="figure_{{ $aTag->id }}" style="display:none; width: 250px;float: left; ">
					<figure><img style="width:16px!important; height:11px!important" id="theImg" src="{{ base_url() }}assets/images/ajax-loader.gif" /> </figure>
					</span>

					<span id="addnewtag_{{ $aTag->id }}" class="addnewtagcontainer" style="display:none; width: 250px;float: left;margin-top: 13px; ">
					<div class="input_box" style="width: 150px;float: left;margin-right: 10px;">
					<input class="form-control input-sm h26" id="txtTagName_{{ $aTag->id }}" name="txtTagName" placeholder="Enter tag name" type="text"></div>
					<a dataId="{{ $aTag->id }}" class="btn btn-xs btn_white_table hidenewtag" href="javascript:void(0)"><i  class="icon-cross2 txt_red"></i></a>
					<button groupID="{{ $aTag->id }}" type="button" class="btn btn-xs btn_white_table addTagfweb"><i class="icon-checkmark3 txt_green"></i></button>
					</span>	
				</div>
				@php 
				$i++;
				@endphp
			@endforeach
	</div>
@endif
<br>
<div style="text-align:center;"><p>Whoops, looks like you don't have any tags yet :-(</p>
<div><a href="{{ base_url('admin/tags/') }}" class="btn bl_cust_btn btn-default">CREATE YOUR FIRST TAG</a></div></div>
<br><br>

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

