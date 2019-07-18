<style>
#tagsApplyPopup .active{background:#5d7df3!important; color: #fff!important;}
</style>
<?php 

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
	
if(!empty($oTags)): ?>
			
<div class="row" id="tagsApplyPopup">
    <?php $i=1; foreach($aTagEntity as $key=>$aGroup){  //pre($aGroup);?>
		<div class="col-md-12">
            <div class="profile_headings" style="margin:0px;<?php echo $i == 1 ? 'margin-top:-20px; border-top:none;' : ''; ?>"><?php echo $aGroup[0]->group_name;?> <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>

			<div class="pb0 pt-15" style="float: left;">
			<?php 
				if(!empty($aGroup)){
					sort($aGroup);
					foreach($aGroup as $aTag){
						if(!empty($aTag->tagid)){
							$resultcheck = search_in_array(trim($aTag->tag_name), $aAppliedTags);

							
						?>
						<input type="checkbox" name="applytag[]" id="allow_comment_<?php echo $aTag->tagid;?>" value="<?php echo $aTag->tagid;?>" class="hidden clsApplyTag" <?php echo $resultcheck != '' ? 'checked' : ''; ?> preview_fname="preview_allow_comments"><label class="btn btn-xs btn_white_table <?php echo $resultcheck != '' ? 'active' : ''; ?>" for="allow_comment_<?php echo $aTag->tagid;?>"> <?php echo $aTag->tag_name;?></label>
						<?php }else{
						?>
						
						<p><i>No Tag Found</i></p>
						<?php
						}
					}
				}
				?>
				<a data-group-id="<?php echo $aTag->id; ?>" class="btn btn-xs btn_white_table addnewtag" href="javascript:void(0)"><i class="icon-plus3"></i></a>
				
				
				

			</div>
			    <span id="figure_<?php echo $aTag->id; ?>" style="display:none; width: 250px;float: left; ">
			    <figure><img style="width:16px!important; height:11px!important" id="theImg" src="<?php echo base_url(); ?>assets/images/ajax-loader.gif" /> </figure>
			    </span>

			    <span id="addnewtag_<?php echo $aTag->id; ?>" class="addnewtagcontainer" style="display:none; width: 250px;float: left;margin-top: 13px; ">
				<div class="input_box" style="width: 150px;float: left;margin-right: 10px;">
				<input class="form-control input-sm h26" id="txtTagName_<?php echo $aTag->id; ?>" name="txtTagName" placeholder="Enter tag name" type="text"></div>
				<a dataId="<?php echo $aTag->id; ?>" class="btn btn-xs btn_white_table hidenewtag" href="javascript:void(0)"><i  class="icon-cross2 txt_red"></i></a>
				<button groupID="<?php echo $aTag->id; ?>" type="button" class="btn btn-xs btn_white_table addTagfweb"><i class="icon-checkmark3 txt_green"></i></button>
				</span>
			
				
					
							
			</div>
			<?php 
			$i++;
			}
			?>
	
</div>

<?php else: ?>
<br>
<div style="text-align:center;"><p>Whoops, looks like you don't have any tags yet :-(</p>
<div><a href="<?php echo base_url('admin/tags/'); ?>" class="btn bl_cust_btn btn-default">CREATE YOUR FIRST TAG</a></div></div>
<br><br>
<?php endif; ?>

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

