<div class="tdropdown">
  <button type="button" class="btn btn-xs btn_white_table bluee dropdown-toggle" data-toggle="dropdown"> <?php echo count($oTags); ?> Tags <span class="caret"></span> </button>
  <ul class="dropdown-menu dropdown-menu-right tagss">
	<?php if (count($oTags) > 0) { 
			foreach ($oTags as $oTag) {    
				?>
				<button class="btn btn-xs btn_white_table pr10"> <?php echo $oTag->tag_name; ?> </button>                                                            
				<?php 
			}
		} 
		?>
	<button class="btn btn-xs plus_icon ml10 <?php echo $actionClass ?>" <?php echo $fieldName ?>="<?php echo $fieldValue; ?>" action_name="<?php echo $actionName;?>"><i class="icon-plus3"></i></button>
  </ul>
  <button class="btn btn-xs plus_icon ml10 <?php echo $actionClass ?>" <?php echo $fieldName ?>="<?php echo $fieldValue; ?>" action_name="<?php echo $actionName;?>"><i class="icon-plus3"></i></button>
</div>

